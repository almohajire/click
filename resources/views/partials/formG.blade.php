@if(empty($value))
    @php $value = null; @endphp

@endif



                <div class="form-group">
                  <label for="{{ $name }}" class="col-sm-2 control-label"> {{ $text }} </label>

                  <div class="col-sm-10">


                    @if( $type == 'color' )

                        @php
                            $primary = ['class' => 'form-control '. $class, 'required' => $required ];
                            $output = array_merge($primary,$additionalInfo);
                        @endphp


                        {!! Form::color($name, $value, $output ) !!}

                    @elseif( $type == 'number' )

                        @php
                            $primary = ['class' => 'form-control '. $class, 'required' => $required ];
                            $output = array_merge($primary,$additionalInfo);
                        @endphp


                        {!! Form::number($name, $value, $output ) !!}

                    @elseif( $type == 'url' )

                        @php
                            $primary = ['class' => 'form-control '. $class, 'required' => $required ];
                            $output = array_merge($primary,$additionalInfo);
                        @endphp


                        {!! Form::url($name, $value, $output) !!}



                    @elseif( $type == 'text' )

                        @php
                            $primary = ['class' => 'form-control '. $class, 'required' => $required ];
                            $output = array_merge($primary,$additionalInfo);
                        @endphp


                        {!! Form::text($name, $value, $output) !!}

                    @elseif( $type == 'tel' )
                        @php
                            $primary = ['class' => 'form-control '. $class, 'required' => $required ];
                            $output = array_merge($primary,$additionalInfo);
                        @endphp


                        {!! Form::tel($name, $value, $output) !!}



                    @elseif( $type == 'email' )

                        @php
                            $primary = ['class' => 'form-control '. $class, 'required' => $required ];
                            $output = array_merge($primary,$additionalInfo);
                        @endphp


                        {!! Form::email($name, $value, $output) !!}

                    @elseif( $type == 'date' )

                        @php
                            $primary = ['class' => 'form-control '. $class, 'required' => $required ];
                            $output = array_merge($primary,$additionalInfo);
                        @endphp


                        {!! Form::date($name, $value, $output) !!}

                    @elseif( $type == 'datetime-local' )

                        @php
                            $primary = ['class' => 'form-control '. $class, 'required' => $required ];
                            $output = array_merge($primary,$additionalInfo);
                        @endphp

                        {{ Form::input('dateTime-local', $name, $value, $output) }}





                    @elseif( $type == 'textarea' )


                        @php
                            $primary = ['class' => 'form-control '. $class, 'required' => $required ];
                            $output = array_merge($primary,$additionalInfo);
                        @endphp

                        {!! Form::textarea($name, $value, $output) !!}

                    @elseif( $type == 'checkbox' )

                        @php
                            $primary = ['class' => $class, 'required' => $required ];
                            $output = array_merge($primary,$additionalInfo);
                        @endphp

                        {!! Form::checkbox( $name , $value , $checked, $output) !!}

                    @elseif($type == 'select')

                        @php
                            $primary = ['class' => 'form-control '. $class, 'required' => $required ];
                            $output = array_merge($primary,$additionalInfo);
                        @endphp

                        {!! Form::select($name, $array, $selected , $output ) !!}

                    @elseif( $type == 'file' )

                        @php
                            $primary = ['class' => 'form-control '. $class ];
                            $output = array_merge($primary,$additionalInfo);
                        @endphp



                    	{!! Form::file($name, null , $output) !!}
                      @if (isset($no_img) && !empty($no_img))
                      @else

                        <div class="text-center">

                                <img src="{{ \App\Helpers\Config\Setting::ifImg( $name ) }}" class="img-responsive" width="30%"/>

                        </div>

                      @endif





                    @endif


                  </div>
                </div>


                    @if ($errors->has($name))
                        <span class="help-block">
                            <strong>{{ $errors->first( $name ) }}</strong>
                        </span>
                    @endif


                    @if( $type == 'file' )



                    @endif