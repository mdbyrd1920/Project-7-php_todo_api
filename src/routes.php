<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function ($request, $response, $args) {
  $endpoints = [
    'all tasks' => $this->api['api_url'].'/todos',
    'single task' => $this->api['api_url'].'/todos/{task_id}',
  /*  'review by task' => $this->api['api_url'].'/tasks/{task_id}/reviews',
    'single review' => $this->api['api_url'].'/tasks/{task_id}/reviews/{review_id}',*/
    'help' => $this->api['base_url']. '/',

  ];
  $result = [
    'endpoints' => $endpoints,
    'version' => $this->api['version'],
    'timestamp' => time(),
  ];
  return $response->withJson($result, 200, JSON_PRETTY_PRINT);
});

$app->group('/api/v1/todos', function() use($app) {

  $app->get('', function ($request, $response, $args) {
  $result = $this->task->getTasks();
  return $response->withJson($result, 200, JSON_PRETTY_PRINT);
  });

  $app->get('/{task_id}', function ($request, $response, $args) {
  $result = $this->task->getTask($args['task_id']);
  return $response->withJson($result, 200, JSON_PRETTY_PRINT);
  });

  $app->post('', function ($request, $response, $args) {
      $data = $request->getParsedBody();
      $data['task_id'] = $args['task_id'];
      $result = $this->task->createTask($data);
      return $response->withJson($result, 201, JSON_PRETTY_PRINT);
  });
  $app->put('/{task_id}', function ($request, $response, $args) {
      $data = $request->getParsedBody();
      $data['task_id'] = $args['task_id'];
      $result = $this->task->updateTask($data);
      return $response->withJson($result, 201, JSON_PRETTY_PRINT);
  });
  $app->delete('/{task_id}', function ($request, $response, $args) {
      $result = $this->task->deleteTask($args['task_id']);
      return $response->withJson($result, 200, JSON_PRETTY_PRINT);
  });










/*
$app->group('/{task_id}/subtask', function() use($app) {
  $app->get('', function ($request, $response, $args) {
  $result = $this->review->getReviewsByTaskId($args['task_id']);
  return $response->withJson($result, 200, JSON_PRETTY_PRINT);

  });
//refer to route grup course to finish
  $app->get('/{task_id}/subtask', function ($request, $response, $args) {
  $result = $this->review->getReviewsByTaskId($args['task_id']);
  return $response->withJson($result, 200, JSON_PRETTY_PRINT);

  });
});*/





});
