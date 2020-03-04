<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function ($request, $response, $args) {
  $endpoints = [
    'all tasks' => $this->api['api_url'].'/tasks',
    'single task' => $this->api['api_url'].'/tasks/{task_id}',
    'review by task' => $this->api['api_url'].'/tasks/{task_id}/reviews',
    'single review' => $this->api['api_url'].'/tasks/{task_id}/reviews/{review_id}',
    'help' => $this->api['base_url']. '/',

  ];
  $result = [
    'endpoints' => $endpoints,
    'verison' => $this->api['version'],
    'timestamp' => time(),
  ];
  return $response->withJson($result, 200, JSON_PRETTY_PRINT);
});

$app->group('api/v1/tasks', function() use($app) {
  $app->get('', function ($request, $response, $args) {
  $result = $this->task->getTasks();
  return $response->withJson($result, 200, JSON_PRETTY_PRINT);
  });

  $app->get('/{task_id}', function ($request, $response, $args) {
  $result = $this->task->getTask($args['task_id']);
  return $response->withJson($result, 200, JSON_PRETTY_PRINT);
  });

  $app->group('/{task_id}/reviews', function() use($app) {
  $app->get('', function ($request, $response, $args) {
  $result = $this->review->getReviewsByTaskId($args['task_id']);
  return $response->withJson($result, 200, JSON_PRETTY_PRINT);

  });
//refer to route grup course to finish
  $app->get('/{task_id}/reviews', function ($request, $response, $args) {
  $result = $this->review->getReviewsByTaskId($args['task_id']);
  return $response->withJson($result, 200, JSON_PRETTY_PRINT);

  });
    });





});
