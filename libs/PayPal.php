<?php
class PayPal
{
    public function checkout($productDetails = [])
    {
        $data = [
            'USER' => $this->getUsername(),
            'PWD' => $this->getPassword(),
            'SIGNATURE' => $this->getSignature(),

            'METHOD' => 'SetExpressCheckout',
            'VERSION' => 114.0,

            'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
            'PAYMENTREQUEST_0_AMT' => $productDetails['preco'],
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'BRL',
            'PAYMENTREQUEST_0_ITEMAMT' => $productDetails['preco'],
            'L_PAYMENTREQUEST_0_NUMBER0' => $productDetails['id'],
            'L_PAYMENTREQUEST_0_NAME0' => $productDetails['nome'],
            'L_PAYMENTREQUEST_0_AMT0' => $productDetails['preco'],
            'PAYMENTREQUEST_0_INVNUM' => rand(),
            'PAYMENTREQUEST_0_CUSTOM' => $productDetails['id'],
            'L_BILLINGAGREEMENTCUSTOM0' => $productDetails['id'],

            'NOSHIPPING' => 1,
            'RETURNURL' => 'http://' . $_SERVER['HTTP_HOST'] . '/loja/obrigado',
            'CANCELURL' => 'http://' . $_SERVER['HTTP_HOST'] . '/loja/compraCancelada'
        ];

        return $this->sendNvpRequest($data)['TOKEN'];
    }

    public function checkStatus($code)
    {

        $data = [
            'USER' => $this->getUsername(),
            'PWD' => $this->getPassword(),
            'SIGNATURE' => $this->getSignature(),

            'METHOD' => 'GetTransactionDetails',
            'VERSION' => 78,

            'TRANSACTIONID' => $code
        ];


        $responseNvp = $this->sendNvpRequest($data);
        if (isset($responseNvp['ACK']) && $responseNvp['ACK'] == 'Success')
            if ($responseNvp['PAYMENTSTATUS'] == 'Completed')
                return TRUE;

            return FALSE;
    }

    public function sendNvpRequest(array $requestNvp)
    {
        if(DB::getInstance()->get('paypal_config')->first()->sandbox == 1) {
            $apiEndpoint = 'https://api-3t.sandbox.paypal.com/nvp';
        } else {
            $apiEndpoint = 'https://api-3t.paypal.com/nvp';
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiEndpoint);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($requestNvp));

        $response = urldecode(curl_exec($curl));

        curl_close($curl);

        $responseNvp = [];

        if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches))
        {
            foreach ($matches['name'] as $offset => $name)
            {
                $responseNvp[$name] = $matches['value'][$offset];
            }
        }

        return $responseNvp;
    }
    public function getUsername(){
        $sth = DB::getInstance()->get('paypal_config',['SHOPKEY', '=', Session::get('SHOPKEY')]);
        if ($sth->count() > 0) {
            return $sth->first()->user;
        } else {
            return NULL;
        }
    }
    public function getPassword(){
        $sth = DB::getInstance()->get('paypal_config',['SHOPKEY', '=', Session::get('SHOPKEY')]);
        if ($sth->count() > 0) {
            return $sth->first()->pass;
        } else {
            return NULL;
        }
    }
    public function getSignature(){
        $sth = DB::getInstance()->get('paypal_config',['SHOPKEY', '=', Session::get('SHOPKEY')]);
        if ($sth->count() > 0) {
            return $sth->first()->sign;
        } else {
            return NULL;
        }
    }

    public function getEmail(){
        $sth = DB::getInstance()->get('pagseguro_config',['SHOPKEY', '=', Session::get('SHOPKEY')]);
        if ($sth->count() > 0) {
            return $sth->first()->email;
        } else {
            return NULL;
        }
    }
    public function getToken(){
        $sth = DB::getInstance()->get('pagseguro_config',['SHOPKEY', '=', Session::get('SHOPKEY')]);
        if ($sth->count() > 0) {
            return $sth->first()->token;
        } else {
            return NULL;
        }
    }

    public function getId(){
        $sth = DB::getInstance()->get('mercadopago_config',['SHOPKEY', '=', Session::get('SHOPKEY')]);
        if ($sth->count() > 0) {
            return $sth->first()->client_id;
        } else {
            return NULL;
        }
    }
    public function getSecret(){
        $sth = DB::getInstance()->get('mercadopago_config',['SHOPKEY', '=', Session::get('SHOPKEY')]);
        if ($sth->count() > 0) {
            return $sth->first()->client_secret;
        } else {
            return NULL;
        }
    }
}