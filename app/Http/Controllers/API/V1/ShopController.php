<?php

namespace App\Http\Controllers\API\V1;
use Illuminate\Http\Request;

class ShopController extends ApiController
{
    /**
     * @var string $_modelClass
     */
    protected $_modelClass = 'App\Model\Shop';

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
            $results = $this->_model->with('products')->paginate($this->_per_page);
        } catch (\Exception $e) {
            return $this->_info(false, 500, $e->getMessage());
        }

        return $results;
    }
}