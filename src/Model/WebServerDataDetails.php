<?php


namespace RoistatParser\Model;

use RoistatParser\SortingMethods\BasicSortingMethod;

/**
 * Class WebServerDataDetails Класс где собрана дополнительная информация об ожидаемых данных, которые будут обрабатываться.
 * На данный момент здесь расположены только коды ответов сервера по стандартам REST API.
 * @see BasicSortingMethod Метод сортировки, где используются коды ответов сервера.
 * @package RoistatParser\Model
 */
class WebServerDataDetails
{
    /**
     * @type int Информационный код ответа.
     */
    const INFO_STATUS_CODE_START = 100;
    /**
     * @type int Успешный код ответа.
     */
    const SUCCESS_STATUS_CODE_START = 200;
    /**
     * @type int Код ответа перенаправления.
     */
    const REDIRECT_STATUS_CODE_START = 300;
    /**
     * @type int Код ответа ошибки клиента.
     */
    const CLIENT_ERROR_STATUS_CODE_START = 400;
    /**
     * @type int Rод ответа ошибки сервера.
     */
    const SERVER_ERROR_STATUS_CODE_START = 500;
}