<template>
	<form @submit.prevent="submit" autocomplete="off">
        <div class="container-fluid py-4 bg-white border rounded border-light shadow">
        	<h2 class="text-center font-weight-bold text-uppercase">Добавить товар</h2>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="text-center">
                        <div v-if="uploadedImageData">
                            <b-img thumbnail fluid :src="uploadedImageData" alt="Загруженное фото" />
                        </div>
                        <div v-else>
                            <b-img thumbnail fluid src="/img/common/default.png" alt="Фото отсутствует" />
                        </div>
                    </div>
                    <div class="py-4">
                        <b-form-group label-class="text-uppercase font-weight-bold" breakpoint="md" label="Вибрать главное фото товара:" label-for="main_photo">
                            <b-form-file id="main_photo" v-model="fields.main_photo" :state="Boolean(errors.main_photo)?false:null" placeholder="Вибрать главное фото товара" @change="previewImage" accept="image/*" ref="fileinput"></b-form-file>
                            <div v-if="errors && errors.main_photo">
                                <b-alert class="text-center" variant="danger" dismissible fade :show="true">{{ errors.main_photo[0] }}</b-alert>
                            </div>
                        </b-form-group>
                        <a class="btn btn-warning w-100 text-uppercase font-weight-bold my-2" @click="resetImage">Сбросить изображение</a>
                    </div>
                </div>
                <div class="col-12 col-md-6">

					<b-form-group label-class="text-uppercase font-weight-bold" label="Цена товара:" label-for="price">
                        <b-form-input id="price" name="price" :state="Boolean(errors && errors.price && errors.price[0])?false:null" type="number" placeholder="Цена товара" v-model="fields.price" step='0.01'></b-form-input>
                        <div v-if="errors && errors.price">
                            <b-alert class="text-center" variant="danger" dismissible fade :show="true">{{ errors.price[0] }}</b-alert>
                        </div>
                    </b-form-group>

                    <b-form-group label-class="text-uppercase font-weight-bold" label="Вибрать категорию:" label-for="category">
                        <b-form-select id="category" name="category" :state="Boolean(errors && errors.category && errors.category[0])?false:null" placeholder="Вибрать категорию" v-model="fields.category" :options="categoriesOptions"></b-form-select>
                        <div v-if="errors && errors.category">
                            <b-alert class="text-center" variant="danger" dismissible fade :show="true">{{ errors.category[0] }}</b-alert>
                        </div>
                    </b-form-group>

                    <b-form-group label-class="text-uppercase font-weight-bold" label="Приоритет:" label-for="priority">
                        <b-form-input id="priority" name="priority" :state="Boolean(errors && errors.priority && errors.priority[0])?false:null" type="number" placeholder="Приоритет" v-model="fields.priority"></b-form-input>
                        <div v-if="errors && errors.priority">
                            <b-alert class="text-center" variant="danger" dismissible fade :show="true">{{ errors.priority[0] }}</b-alert>
                        </div>
                    </b-form-group>

                    <b-form-group label-class="text-uppercase font-weight-bold" breakpoint="md" label="Вибрать видео товара:" label-for="main_video">
                        <b-form-file id="main_video" v-model="fields.main_video" :state="Boolean(errors.main_video)?false:null" placeholder="Вибрать видео товара" accept="video/*"></b-form-file>
                        <div v-if="errors && errors.main_video">
                            <b-alert class="text-center" variant="danger" dismissible fade :show="true">{{ errors.main_video[0] }}</b-alert>
                        </div>
                    </b-form-group>

                    <b-form-group label-class="text-uppercase font-weight-bold" label="Youtube идентификатор:" label-for="youtube">
                        <b-form-input id="youtube" name="youtube" :state="Boolean(errors && errors.youtube && errors.youtube[0])?false:null" type="text" placeholder="Youtube идентификатор" v-model="fields.youtube"></b-form-input>
                        <div v-if="errors && errors.youtube">
                            <b-alert class="text-center" variant="danger" dismissible fade :show="true">{{ errors.youtube[0] }}</b-alert>
                        </div>
                    </b-form-group>




					<b-form-group label-class="text-uppercase font-weight-bold" label="Название товара RU:" label-for="titleRU">
                        <b-form-input id="titleRU" name="titleRU" :state="Boolean(errors && errors.titleRU && errors.titleRU[0])?false:null" type="text" placeholder="Название товара RU" v-model="fields.titleRU"></b-form-input>
                        <div v-if="errors && errors.titleRU">
                            <b-alert class="text-center" variant="danger" dismissible fade :show="true">{{ errors.titleRU[0] }}</b-alert>
                        </div>
                    </b-form-group>
                    <b-form-group label-class="text-uppercase font-weight-bold" label="Название товара UK:" label-for="titleUK">
                        <b-form-input id="titleUK" name="titleUK" :state="Boolean(errors && errors.titleUK && errors.titleUK[0])?false:null" type="text" placeholder="Название товара UK" v-model="fields.titleUK"></b-form-input>
                        <div v-if="errors && errors.titleUK">
                            <b-alert class="text-center" variant="danger" dismissible fade :show="true">{{ errors.titleUK[0] }}</b-alert>
                        </div>
                    </b-form-group>
                    <b-form-group label-class="text-uppercase font-weight-bold" label="Название товара EN:" label-for="titleEN">
                        <b-form-input id="titleEN" name="titleEN" :state="Boolean(errors && errors.titleEN && errors.titleEN[0])?false:null" type="text" placeholder="Название товара EN" v-model="fields.titleEN"></b-form-input>
                        <div v-if="errors && errors.titleEN">
                            <b-alert class="text-center" variant="danger" dismissible fade :show="true">{{ errors.titleEN[0] }}</b-alert>
                        </div>
                    </b-form-group>


                    <b-form-group label-class="text-uppercase font-weight-bold" label="Краткое описание RU:" label-for="short_descriptionRU">
                        <b-form-textarea id="short_descriptionRU" name="short_descriptionRU" :state="Boolean(errors && errors.short_descriptionRU && errors.short_descriptionRU[0])?false:null" placeholder="SEO описання RU" v-model="fields.short_descriptionRU"></b-form-textarea>
                        <div v-if="errors && errors.short_descriptionRU">
                            <b-alert class="text-center" variant="danger" dismissible fade :show="true">{{ errors.short_descriptionRU[0] }}</b-alert>
                        </div>
                    </b-form-group>
                    <b-form-group label-class="text-uppercase font-weight-bold" label="Краткое описание UK:" label-for="short_descriptionUK">
                        <b-form-textarea id="short_descriptionUK" name="short_descriptionUK" :state="Boolean(errors && errors.short_descriptionUK && errors.short_descriptionUK[0])?false:null" placeholder="SEO описання UK" v-model="fields.short_descriptionUK"></b-form-textarea>
                        <div v-if="errors && errors.short_descriptionUK">
                            <b-alert class="text-center" variant="danger" dismissible fade :show="true">{{ errors.short_descriptionUK[0] }}</b-alert>
                        </div>
                    </b-form-group>
                    <b-form-group label-class="text-uppercase font-weight-bold" label="Краткое описание EN:" label-for="short_descriptionEN">
                        <b-form-textarea id="short_descriptionEN" name="short_descriptionEN" :state="Boolean(errors && errors.short_descriptionEN && errors.short_descriptionEN[0])?false:null" placeholder="SEO описання EN" v-model="fields.short_descriptionEN"></b-form-textarea>
                        <div v-if="errors && errors.short_descriptionEN">
                            <b-alert class="text-center" variant="danger" dismissible fade :show="true">{{ errors.short_descriptionEN[0] }}</b-alert>
                        </div>
                    </b-form-group>
                    

                    <b-form-group>
                        <b-button type="submit" class="btn btn-success w-100 text-uppercase font-weight-bold">Сохранить</b-button>
                    </b-form-group>
                </div>
            </div>
        </div>
    </form>
</template>
                   
               
                        
                        <!-- @foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
                           
                            <div class="form-group">
                                {!! Form::label('description'.strtoupper($code), 'Основная часть '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::textarea('description'.strtoupper($code), old('description'.strtoupper($code)), ($errors->has('description'.strtoupper($code)) ? ['class'=>'form-control is-invalid editor'] : ['class'=>'form-control editor'])) !!}
                                <span class="text-danger">{{ $errors->first('description'.strtoupper($code)) }}</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('titleSEO'.strtoupper($code), 'SEO заголовок '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::text('titleSEO'.strtoupper($code), old('titleSEO'.strtoupper($code)), ['placeholder'=>'SEO заголовок '.strtoupper($code)] + ($errors->has('titleSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                <span class="text-danger">{{ $errors->first('titleSEO'.strtoupper($code)) }}</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('descriptionSEO'.strtoupper($code), 'Мета описание '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::textarea('descriptionSEO'.strtoupper($code), old('descriptionSEO'.strtoupper($code)), ['placeholder'=>'Мета описание '.strtoupper($code)] + ($errors->has('descriptionSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                <span class="text-danger">{{ $errors->first('descriptionSEO'.strtoupper($code)) }}</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('keywordsSEO'.strtoupper($code), 'Ключевые слова '.strtoupper($code).':', ['class' => 'text-uppercase font-weight-bold']) !!}
                                {!! Form::text('keywordsSEO'.strtoupper($code), old('keywordsSEO'.strtoupper($code)), ['placeholder'=>'Ключевые слова '.strtoupper($code)] + ($errors->has('keywordsSEO'.strtoupper($code)) ? ['class'=>'form-control is-invalid'] : ['class'=>'form-control'])) !!}
                                <span class="text-danger">{{ $errors->first('keywordsSEO'.strtoupper($code)) }}</span>
                            </div>
                        @endforeach
                        <div id="productAttributes">
                            @if(!empty(old('attributes_namesRU')))
                                @for($i = 0; $i < count(old('attributes_namesRU')); $i++)
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
                                                    @else class="form-control autocomplete-list-target-name"
                                                    @endif 
                                                    value="{{old('attributes_names'.strtoupper($code).'.'.$i)}}">
                                                    <span class="text-danger">{{ $errors->first('attributes_names'.strtoupper($code).'.'.$i) }}</span>
                                                </div>
                                                <div class="col-12 col-sm-6 py-2">
                                                    <label class="text-uppercase font-weight-bold col-12" for="attribute_value_{{strtoupper($code)}}_{{$i+1}}">Значение {{strtoupper($code)}}:</label>
                                                    <input type="text" id="attribute_value_{{strtoupper($code)}}_{{$i+1}}" name="attributes_values{{strtoupper($code)}}[]" placeholder="Значение {{strtoupper($code)}}" 
                                                    @if($errors->has('attributes_values'.strtoupper($code).'.'.$i)) class="form-control autocomplete-list-target-value{{strtoupper($code)}} is-invalid"
                                                    @else class="form-control autocomplete-list-target-value"
                                                    @endif
                                                    value="{{old('attributes_values'.strtoupper($code).'.'.$i)}}">
                                                    <span class="text-danger">{{ $errors->first('attributes_values'.strtoupper($code).'.'.$i) }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endfor
                            @endif -->
                        </div>
                        <button id="add-new-attribute" type="button" class="btn btn-primary w-100 my-4 text-uppercase font-weight-bold" onclick="addNewAttribute()">Добавить характеристику товара</button>
                        <div class="form-group">
                            {!! Form::submit('Добавить товар', ['class'=>'btn btn-success w-100 text-uppercase font-weight-bold']) !!}
                        </div>


<script>
	export default {
		props: [
	        'categories',
	        'localizations'
	    ],
	    data() {
	        return {
	            errors: {},
	            loaded: true,
	            categoriesOptions: [],
	            fields: {},
	            uploadedImageData: null,
	        }
	    },
	    mounted() {
	    	console.log(this.categories);
	    	console.log(this.localizations);
	    },
	    methods: {
	    	previewImage: function(event) {
	            var input = event.target;
	            if (input.files && input.files[0]) {
	                var reader = new FileReader();
	                reader.onload = (e) => {
	                    this.uploadedImageData = e.target.result;
	                }
	                reader.readAsDataURL(input.files[0]);
	            }
	        },
	        resetImage() {
	            this.uploadedImageData = null;
	            this.fields.photo = null;
	            this.$refs.fileinput.reset();
	        }
	    }
	}
</script>