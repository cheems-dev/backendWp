<?php
/*
  Plugin Name: Pokemon Api
  Plugin URI: https://pokemon.com/
  Description: Obtener un pokemon
  Version: 1.0.0
  Author: Cheems Dev
  Author URI: https://pokemon.com/
  License: GPLv2 or later
  Text Domain: pokemonhu
*/

add_action('rest_api_init', function () {
  register_rest_route(
    'pokemon/v1',
    '/pikachu',
    [
      'methods' => 'GET',
      'callback' => 'get_pokemon',
    ]
  );

  register_rest_route(
    'pokemon/v1',
    '/custom',
    [
      'methods' => 'GET',
      'callback' => 'my_custom_pokemon_api',
    ]
  );
});


function get_pokemon(WP_REST_Request $request)
{
  $object = new stdClass();

  $object->name = 'Pikachu';
  $object->type = 'Electrico';
  $object->damage = '24dmg';

  return rest_ensure_response($object);
}

function my_custom_pokemon_api(WP_REST_Request $request)
{

  $name = $request->get_param('name');
  $type = $request->get_param('type');
  $damage = $request->get_param('damage');

  if (!$name) $name = 'Charizard';
  if (!$type) $type = 'Fuego';
  if (!$damage) $damage = '32dmg';

  $object = new stdClass();

  $object->name = $name;
  $object->type = $type;
  $object->damage = $damage;

  return rest_ensure_response($object);
}
