<?php


namespace RoistatParser\SortingMethods;


use RoistatParser\Model\AccessLogItem;
use RoistatParser\Model\WebServerDataDetails;

/**
 * Class BasicSortingMethod Класс стандартной сортировки, который представил Roistat на гитхабе.
 * @see https://gist.github.com/flrnull/7304afeb9e8a1f4faec3#file-script
 * @package RoistatParser\SortingMethods
 */
class BasicSortingMethod extends AbstractSortingMethod
{

    /**
     * @type int Кол-во просмотров
     */
    private $_views;
    /**
     * @type array Массив уникальных ссылок
     */
    private $_urls = [];
    /**
     * @type int Суммарное количество трафика
     */
    private $_traffic = 0;
    /**
     * @type array Отсортированные коды ответов сервера
     */
    private $_statusCodes = [];
    /**
     * @type array Отсортированное кол-во запросов от поисковиков
     */
    private $_crawlers = [];

    /**
     * Добавляет название поисковика в список поисковиков, которые надо тречить.
     * @param string|null $crawler Название поисковика, которое нужно тречить.
     */
    private function addTrackingCrawler(?string $crawler)
    {
        $this->_crawlers[$crawler] = 0;
    }

    /**
     * Инициализация поисковиков, которые надо тречить (Взято с github Roistat'a)
     * @see https://gist.github.com/flrnull/7304afeb9e8a1f4faec3#file-script
     */
    private function _initializeTrackingCrawlers()
    {
        $this->addTrackingCrawler("Google");
        $this->addTrackingCrawler("Bing");
        $this->addTrackingCrawler("Baidu");
        $this->addTrackingCrawler("Yandex");
    }

    /**
     * Сортирует массив по базовому алгоритму.
     * @param AccessLogItem[] Массив спарсенных упрощённых моделей.
     */
    protected function _sort($accessLogItems): void
    {

        $this->_views = count($accessLogItems);
        $this->_initializeTrackingCrawlers();

        foreach ($accessLogItems as $accessLogItem) {
            $this->_trackUniqueUrls($accessLogItem);
            $this->_trackTraffic($accessLogItem);
            $this->_trackCrawlers($accessLogItem);
            $this->_trackStatusCode($accessLogItem);
        }

    }

    /**
     * Метод добавляет уникальные ссылки в массив ссылок.
     * @param AccessLogItem $accessLogItem Упрощённая модель, которая хранит информацию о строке.
     * @see AccessLogItem
     */
    private function _trackUniqueUrls($accessLogItem)
    {
        $url = $accessLogItem->getUrl();
        if (!in_array($url, $this->_urls)) $this->_urls[] = $url;
    }



    /**
     * Я не очень понял, как именно нужно считать трафик,
     * редиректы не считаются, но и наверное ошибки клиента и сервера тоже...
     */

    /**
     * Метод обновляет суммарный трафик, если код ошибки не является кодом редиректа.
     * @param AccessLogItem $accessLogItem Упрощённая модель, которая хранит информацию о строке.
     * @see AccessLogItem
     */
    private function _trackTraffic($accessLogItem)
    {
        $statusCode = $accessLogItem->getStatusCode();
        if (
            $statusCode <= WebServerDataDetails::REDIRECT_STATUS_CODE_START ||
            $statusCode >= WebServerDataDetails::CLIENT_ERROR_STATUS_CODE_START
        ) {
            $this->_traffic += $accessLogItem->getTraffic();
        }
    }

    /**
     * Метод собирает сумму определённых кодов статуса ответа.
     * @param AccessLogItem $accessLogItem Упрощённая модель, которая хранит информацию о строке.
     * @see AccessLogItem
     */
    private function _trackStatusCode($accessLogItem)
    {
        $statusCode = $accessLogItem->getStatusCode();

        if (!isset($this->_statusCodes[$statusCode])) $this->_statusCodes[$statusCode] = 1;
        else $this->_statusCodes[$statusCode]++;
    }

    /**
     * Метод ищет в userAgent упоминания о тречимых поисковиках, если он их находит, то суммирует нахождения этих поисковиков.
     * @param AccessLogItem $accessLogItem Упрощённая модель, которая хранит информацию о строке.
     * @see AccessLogItem
     */
    private function _trackCrawlers($accessLogItem)
    {
        $crawlersNames = array_keys($this->_crawlers);
        $agent = $accessLogItem->getAgent();
        $lowercaseAgent = mb_strtolower($agent);

        foreach ($crawlersNames as $crawlerName) {
            $lowercaseCrawlerName = mb_strtolower($crawlerName);
            if (stristr($lowercaseAgent, $lowercaseCrawlerName) !== FALSE) {
                $this->_crawlers[$crawlerName]++;
                break;
            }
        }
    }

    /**
     * @return array Возвращает отсортированные данные преобразованные в массив.
     * @see BasicSortingMethod::sort()
     */
    protected function _convertSortDataToArray(): array
    {
        $result = [];
        $result['views'] = $this->_views;
        $result['urls'] = count($this->_urls);
        $result['traffic'] = $this->_traffic;
        $result['crawlers'] = $this->_crawlers;
        $result['statusCodes'] = $this->_statusCodes;

        return $result;
    }
}