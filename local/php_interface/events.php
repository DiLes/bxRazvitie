<?
use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler("main", "OnAfterFormRequest", function($event) {
    $params = $event->getParameters();
    $elementId = $params['ELEMENT_ID'];
    $fields = $params['FIELDS'];

    // Например: лог, или email
    \Bitrix\Main\Diag\Debug::writeToFile($fields, "Заявка #$elementId", "/local/logs/request.log");

    // Пример отправки email
    \Bitrix\Main\Mail\Event::send([
        "EVENT_NAME" => "FORM_NEW_REQUEST",
        "LID" => "s1",
        "C_FIELDS" => [
            "NAME" => $fields["NAME"],
            "EMAIL" => $fields["EMAIL"],
            "PHONE" => $fields["PHONE"],
            "COMMENT" => $fields["COMMENT"],
        ]
    ]);
});

