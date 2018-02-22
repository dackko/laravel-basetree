<?php


namespace BaseTree\Tests\Unit\Responses;


use BaseTree\Responses\JsonResponse;
use Illuminate\Http\JsonResponse as LaravelJsonResponse;
use Tests\TestCase;

class JsonResponseTest extends TestCase
{
    /**
     * @var JsonResponse
     */
    protected $instance;

    public function setUp()
    {
        parent::setUp();
        $this->instance = new JsonResponse;
    }

    /** @test */
    public function json_response_is_child_of_laravel_json_response()
    {
        $this->assertTrue($this->instance instanceof LaravelJsonResponse);
    }

    /** @test */
    public function success_default_response()
    {
        $success = $this->instance->success();
        $response = $success->getData();

        $this->assertEquals(JsonResponse::HTTP_OK, $success->getStatusCode());
        $this->assertCount(1, (array)$response);
        $this->assertEquals($response->message, 'Successfully executed.');
    }

    /** @test */
    public function success_modify_default_message()
    {
        $response = $this->instance->success('OK')->getData();
        $this->assertEquals($response->message, 'OK');
    }

    /** @test */
    public function success_append_new_key_to_response()
    {
        $response = $this->instance->success('', ['key' => 'value'])->getData();
        $this->assertCount(2, (array)$response);
        $this->assertNotEmpty($response->key);
        $this->assertEquals($response->key, 'value');
    }

    /** @test */
    public function created_default_response()
    {
        $created = $this->instance->created();
        $response = $created->getData();

        $this->assertEquals(JsonResponse::HTTP_CREATED, $created->getStatusCode());
        $this->assertCount(1, (array)$response);
        $this->assertEquals($response->message, 'Successfully created.');
    }

    /** @test */
    public function created_modify_default_message()
    {
        $response = $this->instance->created('OK')->getData();
        $this->assertEquals($response->message, 'OK');
    }

    /** @test */
    public function created_append_new_key_to_response()
    {
        $response = $this->instance->created('', ['key' => 'value'])->getData();
        $this->assertCount(2, (array)$response);
        $this->assertNotEmpty($response->key);
        $this->assertEquals($response->key, 'value');
    }

    /** @test */
    public function forbidden_default_response()
    {
        $forbidden = $this->instance->forbidden();
        $response = $forbidden->getData();

        $this->assertEquals(JsonResponse::HTTP_FORBIDDEN, $forbidden->getStatusCode());
        $this->assertCount(1, (array)$response);
        $this->assertEquals($response->message, 'Forbidden.');
    }

    /** @test */
    public function forbidden_modify_default_message()
    {
        $response = $this->instance->forbidden('OK')->getData();
        $this->assertEquals($response->message, 'OK');
    }

    /** @test */
    public function unauthorized_default_response()
    {
        $unauthorized = $this->instance->unauthorized();
        $response = $unauthorized->getData();

        $this->assertEquals(JsonResponse::HTTP_UNAUTHORIZED, $unauthorized->getStatusCode());
        $this->assertCount(1, (array)$response);
        $this->assertEquals($response->message, 'Unauthorized.');
    }

    /** @test */
    public function unauthorized_modify_default_message()
    {
        $response = $this->instance->forbidden('OK')->getData();
        $this->assertEquals($response->message, 'OK');
    }

    /** @test */
    public function unprocessed_entity_default_response()
    {
        $unprocessedEntity = $this->instance->unprocessableEntity();
        $response = $unprocessedEntity->getData();

        $this->assertEquals(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $unprocessedEntity->getStatusCode());
        $this->assertCount(1, (array)$response);
        $this->assertEquals($response->message, 'Unprocessable entity.');
    }

    /** @test */
    public function unprocessable_entity_modify_default_message()
    {
        $response = $this->instance->unprocessableEntity('OK')->getData();
        $this->assertEquals($response->message, 'OK');
    }

    /** @test */
    public function unprocessable_entity_append_new_key_to_response()
    {
        $response = $this->instance->unprocessableEntity('', ['key' => 'value'])->getData();
        $this->assertCount(2, (array)$response);
        $this->assertNotEmpty($response->key);
        $this->assertEquals($response->key, 'value');
    }

    /** @test */
    public function not_found_default_response()
    {
        $notFound = $this->instance->notFound();
        $response = $notFound->getData();

        $this->assertEquals(JsonResponse::HTTP_NOT_FOUND, $notFound->getStatusCode());
        $this->assertCount(1, (array)$response);
        $this->assertEquals($response->message, 'Not found.');
    }

    /** @test */
    public function not_found_modify_default_message()
    {
        $response = $this->instance->notFound('OK')->getData();
        $this->assertEquals($response->message, 'OK');
    }

    /** @test */
    public function internal_error_default_response()
    {
        $internalError = $this->instance->internalError();
        $response = $internalError->getData();

        $this->assertEquals(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, $internalError->getStatusCode());
        $this->assertCount(1, (array)$response);
        $this->assertEquals($response->message, 'Internal error.');
    }

    /** @test */
    public function internal_error_modify_default_message()
    {
        $response = $this->instance->internalError('OK')->getData();
        $this->assertEquals($response->message, 'OK');
    }

    /** @test */
    public function json_response_facade_is_registered()
    {
        $this->assertInstanceOf(JsonResponse::class, app('basetree.response.json'));
    }

    /** @test */
    public function json_facade_works()
    {
        $response = \Json::success();

        $this->assertInstanceOf(LaravelJsonResponse::class, $response);
    }
}