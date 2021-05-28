<?php

namespace Drupal\nodewithjson\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\jsonResponse;

/**
 * Class ApiController.
 */
class ApiController extends ControllerBase {

      /**
     * Showkey.
     *
     * @return array
     *
     */
    public function ShowKey($apikey,$nodeid) {

        $values = \Drupal::entityQuery('node')->condition('nid', $nodeid)->execute();
        $nodeid = !empty($values);
        $externalapikey = \Drupal::config('nodewithjson.externalapikey')->get('your_external_api_key');
        if ($apikey == $externalapikey && $nodeid) {
            return new jsonResponse(
                [
                    '#type' => 'markup',
                    '#markup' => $this->t('The External API Key is:  '. $externalapikey),
                    'data' => $this->result(),
                    'method' => 'GET',
              ]
              );
        }
        else {
            return (
                [
                    '#type' => 'markup',
                    '#markup' => $this->t('The API Key you entered is not valid :'.$nodeid),
                ]
            );
        }
  
    }

    private function result() {
        return [
                ["id" => 1, "name" => "Bratislava", "population" => 432000],
                ["id" => 2, "name" => "Budapest", "population" => 1759000],
                ["id" => 3, "name" => "Prague", "population" => 1280000],
                ["id" => 4, "name" => "Warsaw", "population" => 1748000],
                ["id" => 5, "name" => "Los Angeles", "population" => 3971000],
                ["id" => 6, "name" => "New York", "population" => 8550000],
                ["id" => 7, "name" => "Edinburgh", "population" => 464000],
                ["id" => 8, "name" => "Berlin", "population" => 3671000],
            ];
    }
        
}


