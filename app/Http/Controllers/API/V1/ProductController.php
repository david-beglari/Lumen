<?php

namespace App\Http\Controllers\API\V1;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    /**
     * @var string $_modelClass
     */
    protected $_modelClass = 'App\Model\Product';

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->get('per_page') && is_numeric($request->get('per_page'))){
            $this->_per_page = $request->get('per_page');
        }

        try {
            $results = $this->_model->paginate($this->_per_page);
        } catch (\Exception $e) {
            return $this->_info(false, 500, $e->getMessage());
        }

        return $results;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'shop_id' => 'required',
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $errorMessage = "Validation Failed";
            foreach ($validator->errors()->all() as $key => $value) {
                $errorMessage = $errorMessage . '. ' . $value;
            }
            return $this->_info(false, 422, $errorMessage);
        }

        return parent::store($request);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'shop_id' => 'required',
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            $errorMessage = "Validation Failed";
            foreach ($validator->errors()->all() as $key => $value) {
                $errorMessage = $errorMessage . '. ' . $value;
            }
            return $this->_info(false, 422, $errorMessage);
        }

        return parent::update($request, $id);
    }
}