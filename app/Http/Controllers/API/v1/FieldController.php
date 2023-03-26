<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FieldRequest;
use App\Models\Field;
use App\Traits\HttpResponses;
use BadMethodCallException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    use HttpResponses;
    public function __construct(Field $Fields)
    {
        $this->fieldsModel = $Fields;
    }
    public function handleMethod(callable $callback)
    {
        $callback();
    }
    public function getFields()
    {
        try {
            $fields = $this->fieldsModel->getFields();
            if ($fields != null) {
                return $this->success("get fields success", $fields);
            } else {
                return $this->error("get fields failed!");
            }
        } catch (ModelNotFoundException $th) {
            return $this->error("Model error: " . $this->customMessage($th, "some part is not found!"));
        } catch (BadMethodCallException $th) {
            return $this->error("Method error: " . $this->customMessage($th, "unavailable action!"));
        } catch (QueryException $th) {
            return $this->error("Query error: " . $this->customMessage($th, "something wrong with syntax!"));
        } catch (\Exception $th) {
            return $this->error("General error: " . $this->customMessage($th, "Something wrong in system!"));
        }
    }
    public function store(FieldRequest $request)
    {
        try {
            return $request;
        } catch (ModelNotFoundException $th) {
            return $this->error("Model error: " . $this->customMessage($th, "some part is not found!"));
        } catch (BadMethodCallException $th) {
            return $this->error("Method error: " . $this->customMessage($th, "unavailable action!"));
        } catch (QueryException $th) {
            return $this->error("Query error: " . $this->customMessage($th, "something wrong with syntax!"));
        } catch (\Exception $th) {
            return $this->error("General error: " . $this->customMessage($th, "Something wrong in system!"));
        }
    }
}
