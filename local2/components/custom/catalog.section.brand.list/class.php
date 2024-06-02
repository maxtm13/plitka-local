<?

use Bitrix\Main\Loader;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Application;

class CBitrixCatalogSectionBrandList extends CBitrixComponent
{
    const CACHE_TIME = 3600;
    const BRAND_PROPERTY_ID = [284, 250, 126];
    const FILTER_PREFIX = '?set_filter=y&';

    protected $cache;
    protected $values = [];
    protected $alphabet = [];
    protected $alphabetSectionsList = [];

    public function executeComponent()
    {
        $this->cache = Application::getInstance()->getManagedCache();

        $this->getAlphabetListFromSections();

        $this->parseBrandValues();

        $this->fillResultAlphabetList();

        $this->includeComponentTemplate();
    }

    protected function getAlphabetListFromSections()
    {
        $cacheId = 'alphabet_sections_list_iblock_' . $this->arParams["IBLOCK_ID"];

        if ($this->cache->read(self::CACHE_TIME, $cacheId)) {
            $this->alphabetSectionsList = $this->cache->get($cacheId);
        } else {
            $this->alphabetSectionsList = [];

            if (CModule::IncludeModule("iblock")) {
                $arSelect = [
                    "ID",
                    "NAME",
                    "CODE",
                    "IBLOCK_ID",
                    "IBLOCK_SECTION_ID",
                    "LEFT_MARGIN",
                    "RIGHT_MARGIN",
                    "PICTURE",
                    "SECTION_PAGE_URL"
                ];

                $arFilter = [
                    "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
                    "IBLOCK_LID" => SITE_ID,
                    "IBLOCK_ACTIVE" => "Y",
                    "ACTIVE_DATE" => "Y",
                    "ACTIVE" => "Y",
                    "CHECK_PERMISSIONS" => "N",
                    "DEPTH_LEVEL" => 2
                ];

                $arFilter['DEPTH_LEVEL'] = 2;
                $res = CIBlockSection::GetList(["NAME" => "asc"], $arFilter, false, $arSelect, false);

                $arResult['list'] = [];

                while ($fields = $res->GetNext()) {
                    $name = $fields['NAME'];
                    $name = LANG_CHARSET != 'windows-1251' ? iconv(LANG_CHARSET, 'windows-1251', $name) : $name;

                    $name = iconv('windows-1251', LANG_CHARSET, $name);

                    $this->alphabetSectionsList[] = [
                        "NAME" => $name,
                        "CODE" => $fields['CODE'],
                        "URL" => $fields['SECTION_PAGE_URL'],
                    ];
                }
            }

            $this->cache->setImmediate($cacheId, $this->alphabetSectionsList);
        }
    }

    protected function parseBrandValues()
    {
        global $catalogSmartFilterResult;

        foreach (static::BRAND_PROPERTY_ID as $brandId) {
            // Поиск в массиве фильтра соответствующего поля (в зависимости от инфоблока ID поля "Производитель" разное)
            if (!empty($catalogSmartFilterResult['ITEMS'][$brandId])) {
                foreach ($catalogSmartFilterResult['ITEMS'][$brandId]['VALUES'] as $key => $item) {
                    $brandVals = [];
                    $brandVals = $this->getBrandUrlByName($item['VALUE']);

                    if ($brandVals !== false) {
                        $this->values[$key] = $brandVals;
                    }
                };
                break;
            }
        }
    }

    protected function getBrandUrlByName($name)
    {
        foreach ($this->alphabetSectionsList as $item) {
            if ($item['NAME'] == $name) {
                return $item;
            }
        }
        return false;
    }

    protected function fillResultAlphabetList()
    {
        foreach ($this->values as $value) {
            $firstLetter = mb_substr($value['NAME'], 0, 1);
            if (!empty($firstLetter)) {
                $this->arResult['ITEMS'][$firstLetter][] = $value;
            }
        }

        ksort($this->arResult['ITEMS']);
    }
}