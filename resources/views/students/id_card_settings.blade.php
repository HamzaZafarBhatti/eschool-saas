@extends('layouts.master')

@section('title')
    {{ __('student_id_card') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ __('student_id_card') }} {{ __('settings') }}
            </h3>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <form class="pt-3 create-form-without-reset" id="formdata" action="{{ url('students/id-card-settings') }}" method="POST" novalidate="novalidate">
                            <div class="row">
                                {{-- Colour --}}
                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="header_color">{{ __('header_color') }} <span class="text-danger">*</span></label>
                                    <input name="header_color" id="header_color" value="{{ $settings['header_color'] ?? '' }}" type="text" required placeholder="{{ __('color') }}" class="color-picker"/>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="footer_color">{{ __('footer_color') }} <span class="text-danger">*</span></label>
                                    <input name="footer_color" id="footer_color" value="{{ $settings['footer_color'] ?? '' }}" type="text" required placeholder="{{ __('color') }}" class="color-picker"/>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="header_footer_color">{{ __('header_footer_text_color') }} <span class="text-danger">*</span></label>
                                    <input name="header_footer_text_color" id="header_footer_text_color" value="{{ $settings['header_footer_text_color'] ?? '' }}" type="text" required placeholder="{{ __('color') }}" class="color-picker"/>
                                </div>
                                {{-- End Colour --}}

                                {{-- Layout Type --}}
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('layout_type') }} <span class="text-danger">*</span></label>
                                    <div class="col-12 d-flex row">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" @if(isset($settings['layout_type'])  && $settings['layout_type'] == 'vertical') checked @endif name="layout_type" id="layout_type" value="vertical" required>
                                                {{ __('vertical') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" @if(isset($settings['layout_type'])  && $settings['layout_type'] == 'horizontal') checked @endif name="layout_type" id="layout_type" value="horizontal" required>
                                                {{ __('horizontal') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Layout Type --}}

                                {{-- Profile Image Style --}}
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>{{ __('profile_image_style') }} <span class="text-danger">*</span></label>
                                    <div class="col-12 d-flex row">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" @if(isset($settings['profile_image_style']) && $settings['profile_image_style'] == 'round') checked @endif name="profile_image_style" id="profile_image_style" value="round" required>
                                                {{ __('round') }}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" @if(isset($settings['profile_image_style']) && $settings['profile_image_style'] == 'squre') checked @endif name="profile_image_style" id="profile_image_style" value="squre" required>
                                                {{ __('squre') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Profile Image Style --}}

                                {{-- Background Image --}}
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="image">{{ __('background_image') }} </label>
                                    <input type="file" name="background_image" accept="image/jpg,image/png,image/jpeg,image/svg" class="file-upload-default"/>
                                    <div class="input-group col-xs-12">
                                        <input type="text" id="image" class="form-control file-upload-info" disabled="" placeholder="{{ __('image') }}"/>
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-theme" type="button">{{ __('upload') }}</button>
                                        </span>
                                    </div>
                                    @if ($settings['background_image'] ?? '')
                                    <div id="background">
                                        <img src="{{ $settings['background_image'] }}" class="img-fluid w-25" alt="">

                                        <div class="mt-2">
                                            <a href="" data-type="background" class="btn btn-inverse-danger btn-sm student-id-card-settings">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>                                        
                                    @endif
                                </div>
                                {{-- End Background Image --}}

                                {{-- Signature --}}
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="image">{{ __('signature') }} </label>
                                    <input type="file" name="signature" accept="image/jpg,image/png,image/jpeg,image/svg" class="file-upload-default"/>
                                    <div class="input-group col-xs-12">
                                        <input type="text" id="image" class="form-control file-upload-info" disabled="" placeholder="{{ __('image') }}"/>
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-theme" type="button">{{ __('upload') }}</button>
                                        </span>
                                    </div>
                                    @if ($settings['signature'] ?? '')
                                    <div id="signature">
                                        <img src="{{ $settings['signature'] }}" class="img-fluid w-25" alt="">
                                        <div class="mt-2">
                                            <a href="" data-type="signature" class="btn btn-inverse-danger btn-sm student-id-card-settings">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                {{-- End Signature --}}

                                {{-- Fields --}}
                                <div class="form-group col-sm-12 col-md-12">
                                    <label for="">{{ __('select_fields') }} <span class="text-danger">*</span></label>
                                </div>

                                <div class="form-group col-sm-12 col-md-3">
                                    <input id="student_name" class="feature-checkbox" @if(in_array('student_name',$settings['student_id_card_fields'])) checked @endif type="checkbox" name="student_id_card_fields[]" value="student_name"/>
                                    <label class="feature-list text-center" for="student_name">{{ __('student_name') }}</label>
                                </div>
                                <div class="form-group col-sm-12 col-md-3">
                                    <input id="class_section" class="feature-checkbox" @if(in_array('class_section',$settings['student_id_card_fields'])) checked @endif type="checkbox" name="student_id_card_fields[]" value="class_section"/>
                                    <label class="feature-list text-center" for="class_section">{{ __('class_section') }}</label>
                                </div>
                                <div class="form-group col-sm-12 col-md-3">
                                    <input id="roll_number" class="feature-checkbox" type="checkbox" @if(in_array('roll_no',$settings['student_id_card_fields'])) checked @endif name="student_id_card_fields[]" value="roll_no"/>
                                    <label class="feature-list text-center" for="roll_number">{{ __('roll_no') }}</label>
                                </div>
                                <div class="form-group col-sm-12 col-md-3">
                                    <input id="dob" class="feature-checkbox" type="checkbox" @if(in_array('dob',$settings['student_id_card_fields'])) checked @endif name="student_id_card_fields[]" value="dob"/>
                                    <label class="feature-list text-center" for="dob">{{ __('dob') }}</label>
                                </div>
                                <div class="form-group col-sm-12 col-md-3">
                                    <input id="gender" class="feature-checkbox" type="checkbox" @if(in_array('gender',$settings['student_id_card_fields'])) checked @endif name="student_id_card_fields[]" value="gender"/>
                                    <label class="feature-list text-center" for="gender">{{ __('gender') }}</label>
                                </div>
                                <div class="form-group col-sm-12 col-md-3">
                                    <input id="session_year" class="feature-checkbox" type="checkbox" @if(in_array('session_year',$settings['student_id_card_fields'])) checked @endif name="student_id_card_fields[]" value="session_year"/>
                                    <label class="feature-list text-center" for="session_year">{{ __('session_year') }}</label>
                                </div>
                                <div class="form-group col-sm-12 col-md-3">
                                    <input id="guardian_name" class="feature-checkbox" type="checkbox" @if(in_array('guardian_name',$settings['student_id_card_fields'])) checked @endif name="student_id_card_fields[]" value="guardian_name"/>
                                    <label class="feature-list text-center" for="guardian_name">{{ __('guardian') }} {{ __('name') }}</label>
                                </div>
                                <div class="form-group col-sm-12 col-md-3">
                                    <input id="guardian_contact" class="feature-checkbox" @if(in_array('guardian_contact',$settings['student_id_card_fields'])) checked @endif type="checkbox" name="student_id_card_fields[]" value="guardian_contact"/>
                                    <label class="feature-list text-center" for="guardian_contact">{{ __('guardian') }} {{ __('contact') }}</label>
                                </div>
                                {{-- End Fields --}}

                                <div class="form-group col-sm-12 col-md-12">

                                </div>
                                
                                {{-- Page Size --}}
                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="">{{ __('page_width') }} ({{ __('mm') }})<span class="text-danger">*</span></label>
                                    <input name="page_width" id="page_width" value="{{ $settings['page_width'] ?? '' }}" type="number" required placeholder="{{ __('page_width') }}" class="form-control"/>
                                </div>

                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="">{{ __('page_height') }} ({{ __('mm') }})<span class="text-danger">*</span></label>
                                    <input name="page_height" id="page_height" value="{{ $settings['page_height'] ?? '' }}" type="number" required placeholder="{{ __('page_height') }}" class="form-control"/>
                                </div>
                                {{-- End Page Size --}}
                               
                            </div>
                            <input class="btn btn-theme" id="create-btn" type="submit" value={{ __('submit') }}>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    
@endsection
