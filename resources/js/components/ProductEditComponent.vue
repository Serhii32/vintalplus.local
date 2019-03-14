<template>
    <div id="productAttributes">

        @if(!empty(old('attributes_names')) || !empty($product->attributesNames()->get()))
            @if(!empty($product->attributesNames()->get()))
                @php $i = 0; $k = 0; $previous = ''; $attributesNamesOrderedArray = $product->attributesNames()->orderBy('nameRU')->get(); @endphp
                @for($i; $i < count($attributesNamesOrderedArray); $i++)
                    <div class="existed-attributes form-group py-4 border-bottom" id="attribute{{$i+1}}">
                        <div class="row">
                            <p class="text-uppercase font-weight-bold col-12 col-sm-6">Характеристика {{$i+1}}</p>

                            @if($previous == $attributesNamesOrderedArray[$i]->nameRU)
                                @php $k++; @endphp
                            @else
                                @php $k=0; @endphp
                            @endif
                            @php $previous = $attributesNamesOrderedArray[$i]->nameRU @endphp
                           
                            <div class="col-12 col-sm-6">
                                <a class="float-right btn btn-danger text-uppercase font-weight-bold" onclick="return confirm('Подтвердить удаление?')" href="{{route('admin.products.productAttributeDestroy', [$product->id, $attributesNamesOrderedArray[$i]->id, $attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get()[$k]->id])}}">Удалить</a>
                            </div>

                        </div>
                        @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                            <div class="row">
                                <div class="col-12 col-sm-6 py-2">
                                    <label class="text-uppercase font-weight-bold col-12" for="attribute_name_{{strtoupper($code)}}_{{$i+1}}">Название {{strtoupper($code)}}:</label>
                                    <input type="text" id="attribute_name_{{strtoupper($code)}}_{{$i+1}}" name="attributes_names{{strtoupper($code)}}[]" placeholder="Название {{strtoupper($code)}}" 
                                    @if($errors->has('attributes_names_'.strtoupper($code).'_'.$i)) class="form-control autocomplete-list-target-name{{strtoupper($code)}} is-invalid" 
                                    @else class="form-control autocomplete-list-target-name{{strtoupper($code)}}"
                                    @endif 
                                    value="{{old('attributes_names'.strtoupper($code).'.'.$i) ?: $attributesNamesOrderedArray[$i]->{'name'.strtoupper($code)} }}">
                                    <span class="text-danger">{{ $errors->first('attributes_names_'.strtoupper($code).'_'.$i) }}</span>
                                </div>
                                <div class="col-12 col-sm-6 py-2">
                                    <label class="text-uppercase font-weight-bold col-12" for="attribute_value_{{strtoupper($code)}}_{{$i+1}}">Значение {{strtoupper($code)}}:</label>
                                    <input type="text" id="attribute_value_{{strtoupper($code)}}_{{$i+1}}" name="attributes_values{{strtoupper($code)}}[]" placeholder="Значение {{strtoupper($code)}}" 
                                    @if($errors->has('attributes_values_'.strtoupper($code).'_'.$i)) class="form-control autocomplete-list-target-value{{strtoupper($code)}} is-invalid"
                                    @else class="form-control autocomplete-list-target-value{{strtoupper($code)}}"
                                    @endif
                                    value="{{old('attributes_values'.strtoupper($code).'.'.$i) ?: $attributesNamesOrderedArray[$i]->values()->whereHas('products', function($query)use($product){$query->where('product_id', '=', $product->id);})->get()[$k]->{'value'.strtoupper($code)} }}">
                                    <span class="text-danger">{{ $errors->first('attributes_values_'.strtoupper($code).'_'.$i) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>                                            
                @endfor
            @endif
            @if(!empty(old('attributes_namesRU')))
                @for($i; $i < count(old('attributes_namesRU')); $i++)
                    <div class="existed-attributes form-group py-4 border-bottom" id="attribute{{$i+1}}">
                        <div class="row">
                            <p class="text-uppercase font-weight-bold col-12 col-sm-6">Характеристика {{$i+1}}</p>
                            <div class="col-12 col-sm-6">
                                <a class="float-right btn btn-danger text-uppercase font-weight-bold" onclick="deleteAttribute('attribute{{$i+1}}')" href="javascript:void(0)">Удалить</a>
                            </div>
                        </div>
                        @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                            <div class="row">
                                <div class="col-12 col-sm-6 py-2">
                                    <label class="text-uppercase font-weight-bold col-12" for="attribute_name_{{strtoupper($code)}}_{{$i+1}}">Название {{strtoupper($code)}}:</label>
                                    <input type="text" id="attribute_name_{{strtoupper($code)}}_{{$i+1}}" name="attributes_names{{strtoupper($code)}}[]" placeholder="Название {{strtoupper($code)}}" 
                                    @if($errors->has('attributes_names'.strtoupper($code).'.'.$i)) class="form-control autocomplete-list-target-name{{strtoupper($code)}} is-invalid" 
                                    @else class="form-control autocomplete-list-target-name{{strtoupper($code)}}"
                                    @endif 
                                    value="{{old('attributes_names'.strtoupper($code).'.'.$i)}}">
                                    <span class="text-danger">{{ $errors->first('attributes_names'.strtoupper($code).'.'.$i) }}</span>
                                </div>
                                <div class="col-12 col-sm-6 py-2">
                                    <label class="text-uppercase font-weight-bold col-12" for="attribute_value_{{strtoupper($code)}}_{{$i+1}}">Значение {{strtoupper($code)}}:</label>
                                    <input type="text" id="attribute_value_{{strtoupper($code)}}_{{$i+1}}" name="attributes_values{{strtoupper($code)}}[]" placeholder="Значение {{strtoupper($code)}}" 
                                    @if($errors->has('attributes_values'.strtoupper($code).'.'.$i)) class="form-control autocomplete-list-target-value{{strtoupper($code)}} is-invalid"
                                    @else class="form-control autocomplete-list-target-value{{strtoupper($code)}}"
                                    @endif
                                    value="{{old('attributes_values'.strtoupper($code).'.'.$i)}}">
                                    <span class="text-danger">{{ $errors->first('attributes_values'.strtoupper($code).'.'.$i) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endfor
            @endif
        @endif

    </div>
    <button id="add-new-attribute" type="button" class="btn btn-primary w-100 my-4 text-uppercase font-weight-bold" onclick="addNewAttribute()">Добавить характеристику товара</button>
</template>
<script>
export default {
    
}
</script>