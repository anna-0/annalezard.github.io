<?php
/**
 * WARNING: Do not edit by hand, this file was generated by Crank:
 *
 * https://github.com/gocardless/crank
 */

namespace GoCardlessPro\Services;

use \GoCardlessPro\Core\Paginator;
use \GoCardlessPro\Core\Util;
use \GoCardlessPro\Core\ListResponse;
use \GoCardlessPro\Resources\Payout;
use \GoCardlessPro\Core\Exception\InvalidStateException;


/**
 * Service that provides access to the Payout
 * endpoints of the API
 *
 * @method list()
 * @method get()
 * @method update()
 */
class PayoutsService extends BaseService
{

    protected $envelope_key   = 'payouts';
    protected $resource_class = '\GoCardlessPro\Resources\Payout';


    /**
     * List payouts
     *
     * Example URL: /payouts
     *
     * @param  string[mixed] $params An associative array for any params
     * @return ListResponse
     **/
    protected function _doList($params = array())
    {
        $path = "/payouts";
        if(isset($params['params'])) { $params['query'] = $params['params'];
            unset($params['params']);
        }

        
        $response = $this->api_client->get($path, $params);
        

        return $this->getResourceForResponse($response);
    }

    /**
     * Get a single payout
     *
     * Example URL: /payouts/:identity
     *
     * @param  string        $identity Unique identifier, beginning with "PO".
     * @param  string[mixed] $params   An associative array for any params
     * @return Payout
     **/
    public function get($identity, $params = array())
    {
        $path = Util::subUrl(
            '/payouts/:identity',
            array(
                
                'identity' => $identity
            )
        );
        if(isset($params['params'])) { $params['query'] = $params['params'];
            unset($params['params']);
        }

        
        $response = $this->api_client->get($path, $params);
        

        return $this->getResourceForResponse($response);
    }

    /**
     * Update a payout
     *
     * Example URL: /payouts/:identity
     *
     * @param  string        $identity Unique identifier, beginning with "PO".
     * @param  string[mixed] $params   An associative array for any params
     * @return Payout
     **/
    public function update($identity, $params = array())
    {
        $path = Util::subUrl(
            '/payouts/:identity',
            array(
                
                'identity' => $identity
            )
        );
        if(isset($params['params'])) { 
            $params['body'] = json_encode(array($this->envelope_key => (object)$params['params']));
        
            unset($params['params']);
        }

        
        $response = $this->api_client->put($path, $params);
        

        return $this->getResourceForResponse($response);
    }

    /**
     * List payouts
     *
     * Example URL: /payouts
     *
     * @param  string[mixed] $params
     * @return Paginator
     **/
    public function all($params = array())
    {
        return new Paginator($this, $params);
    }

}
