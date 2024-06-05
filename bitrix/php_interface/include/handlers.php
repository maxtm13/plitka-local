<?
// Перехват события обновления инфоблока
// AddEventHandler("iblock", "OnAfterIBlockUpdate", "bxUpdateIBlock");

// Перехват события обновления/добавления/удаления элемента инфоблока -Старое перестало нормально работать
// AddEventHandler("iblock", "OnAfterIBlockElementAdd", "bxUpdateIBlockElement");
// AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "bxUpdateIBlockElement");
// AddEventHandler("iblock", "OnIBlockElementDelete", "bxDeleteIBlockElement");

// Перехват события обновления/добавления/удаления элемента инфоблока

AddEventHandler("iblock", "OnAfterIBlockElementAdd", "manageItems");
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "manageItems");
AddEventHandler("iblock", "OnIBlockElementDelete", "manageItems");

AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", "manageSection");

// Добавление новых полей для формирования письма о новом заказе
AddEventHandler("sale", "OnOrderNewSendEmail", "bxModifySaleMails");
AddEventHandler("sale", "OnOrderStatusSendEmail", "bxModifySaleMails");
//Перехват события добавления заказа
AddEventHandler("sale", "OnOrderSave", "bxOnOrderSave");

// Добавление товара в каталог
AddEventHandler("catalog", "OnProductAdd", "bxProductAdd");

// OnPageStart
AddEventHandler("main", "OnPageStart", "checkUrl");
AddEventHandler('main', 'OnPageStart', "OnPageRequest");


//Перехват события добавления комментария к блогу
AddEventHandler("blog", "OnBeforeCommentAdd", "bxBeforeBlogCommentAdd");

// Добавление кода тоара в поиск
// регистрируем обработчик
AddEventHandler("search", "BeforeIndex", "BeforeIndexHandler");

//Подмена цены на ночную
AddEventHandler("sale", "OnBeforeBasketAdd", "omniOnBeforeBasketAdd");

AddEventHandler("main", "OnEndBufferContent", "delete_type");