<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 12.09.17
 * Time: 14:25
 */

define("TOKEN_KD", "qqQSLo8byljcAPH6mJ7lc0KgFtL9NoFP");
class connect
{
    //заголовки для подключения
    private $_headers = [
        'Authorization: Bearer',
        'Accept: application/json',
        'Content-type: application/json'
    ];


    /**
     * Подключение методом GET
     * @param $token
     * @param $url
     * @param null $data
     * @return mixed
     */
    public function get($token, $url, array $data=null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url.($data!=null ? '?'.$this->prepare_get_params($data) : ''));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers($token));
        $out = curl_exec($curl);
        curl_close($curl);
        return $out;
    }

    /**
     * Подключение методом POST
     * @param $token
     * @param $url
     * @param $data
     * @return mixed
     */
    public function post($token, $url, array $data)
    {
        $data = json_encode($data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array_merge($this->headers($token),['Content-Length: ' . strlen($data)]));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);

        $out = curl_exec($curl);
        curl_close($curl);
        return $out;
    }

    /**
     * Подготовка параметров для GET запроса
     * @param $data
     * @return string
     */
    private function prepare_get_params(array $data)
    {
        return http_build_query($data);
    }

    private function headers($token)
    {
        $headers = $this->_headers;
        $headers[0] = $headers[0].' '.TOKEN_KD;
        return $headers;
    }


}
class kd
{
/*    const URL = [
        'search' => 'https://apiopt.kolesa-darom.ru/v2/search',
        'order' => 'https://apiopt.kolesa-darom.ru/v2/order',
        'work'=> 'https://apiopt.kolesa-darom.ru/v2/order/work',
        'motion' => 'https://apiopt.kolesa-darom.ru/v2/motion',
        'stores' => 'https://apiopt.kolesa-darom.ru/v2/client/stores',
        'addresses' => 'https://apiopt.kolesa-darom.ru/v2/client/addresses',
        'limit' => 'https://apiopt.kolesa-darom.ru/v2/client/limit',
        'shipping' => 'https://apiopt.kolesa-darom.ru/v2/client/shipping',
    ];*/
    const URL_search = 'https://apiopt.kolesa-darom.ru/v2/search';
    const URL_order = 'https://apiopt.kolesa-darom.ru/v2/order';
    const URL_work = 'https://apiopt.kolesa-darom.ru/v2/order/work';
    const URL_motion = 'https://apiopt.kolesa-darom.ru/v2/motion';
    const URL_stores = 'https://apiopt.kolesa-darom.ru/v2/client/stores';
    const URL_addresses = 'https://apiopt.kolesa-darom.ru/v2/client/addresses';
    const URL_limit = 'https://apiopt.kolesa-darom.ru/v2/client/limit';
    const URL_shipping = 'https://apiopt.kolesa-darom.ru/v2/client/shipping';


  /**
     *   метод поиска товаров
     * @param string $token - токен пользователя, для подключения к api
     * @param array $data - массив с данными для поиска
     * @return mixed
     */
    public static function search($token, array $data)
    {
        return self::connect()->get($token,self::URL_search,$data);
    }

    /**
     *  метод для совершения заказа
     * @param string $token - токен пользователя, для подключения к api
     * @param array $data - массив с данными для заказа
     * @return mixed
     */
    public static function order($token, array $data)
    {
        return self::connect()->post($token,self::URL_order,$data);
    }

    /**
     *  метод для поставновки заказа в отгрузку из резерва
     * @param string $token - токен пользователя, для подключения к api
     * @param array $data - номер заказа
     * @return mixed
     */
    public static function work($token, array $data)
    {
        return self::connect()->get($token,self::URL_work,$data);
    }

    /**
     *  метод для получения информации о заказе
     * @param string $token  - токен пользователя, для подключения к api
     * @param array $data  - номер заказа
     * @return mixed
     */
    public static function motion($token, array $data)
    {
        return self::connect()->get($token,self::URL_motion,$data);
    }

    /**
     *  метод для получения списка магазинов в городе, который указан в проыиле,
     *  с которых разрешен самовывоз
     * @param string $token - токен пользователя, для подключения к api
     * @return mixed
     */
    public static function stores($token)
    {
        return self::connect()->get($token,self::URL_stores);
    }

    /**
     *  метод для получения списка адресов доставки, указанные в профиле
     * @param string $token - токен пользователя, для подключения к api
     * @return mixed
     */
    public static function addresses($token)
    {
        return self::connect()->get($token,self::URL_addresses);
    }


    /**
     *  метод для получния лимита, если пользователь работает по отсрочке
     * @param $token - токен пользователя, для подключения к api
     * @return string mixed
     */
    public static function limit($token)
    {
        return self::connect()->get($token,self::URL_limit);
    }

    /**
     *  метод для определения доступен самовывоз/доставка
     * @param string $token - токен пользователя, для подключения к api
     * @return mixed
     */
    public static function shipping($token)
    {
        return self::connect()->get($token,self::URL_shipping);
    }

    /**
     * метод возвращает класс для соединения с сервером
     * @return connect
     */
    private static function connect()
    {
        return new connect();
    }

}