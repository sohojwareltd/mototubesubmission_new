@extends('layouts.app')
@section('above_header')
    <div class="form-right-graphics wow fadeInUp" data-wow-delay="0.4s">
        <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 154 880" width="154" height="880">
            <title>Group 26-svg</title>
            <style>
                .s0 {
                    fill: #c20000
                }

                .s1 {
                    fill: #c20000;
                    stroke: #ffffff;
                    stroke-width: 12
                }

                .s2 {
                    fill: #ac0000
                }
                #video_control{
                    opacity:0
                }
            </style>
            <path id="Layer" class="s0"
                d="m702 1141c-388.2 0-702-313.8-702-702 0-388.2 313.8-702 702-702 388.2 0 702 313.8 702 702 0 388.2-313.8 702-702 702z" />
            <path id="Layer" class="s1"
                d="m684 1085c-356.7 0-645-288.3-645-645 0-356.7 288.3-645 645-645 356.7 0 645 288.3 645 645 0 356.7-288.3 645-645 645z" />
            <path id="Layer" class="s2"
                d="m801 1133c-388.2 0-702-313.8-702-702 0-388.2 313.8-702 702-702 388.2 0 702 313.8 702 702 0 388.2-313.8 702-702 702z" />
        </svg>
    </div>
@stop
@section('content')
    <div class="inner-spacing">
        <div class="section-content">
            <div class="container">
                <div class="content-box wow fadeInUp" data-wow-delay="0.1s">
                    <div class="content-left">
                        <h3>Filmed a worthy clip?</h3>
                        <h2>Wanna get paid?</h2>
                    </div>
                    <div class="content-right">
                        <p>Just use the form below to tell us more about yourself and your video. If selected, we will pitch
                            your content to our media partners, negotiate deals on your behalf, and protect your copyright.
                            We do all of this on a profit share basis so it doesn't cost you anything.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-section">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-section-wrap form_exists">
                <form method="post" action="{{route('submit.post')}}" id="submit_form">
                    @csrf
                    <div class="form-lists">
                        <h4 class="wow fadeInUp" data-wow-delay="0.1s">LET'S LEARN MORE ABOUT YOUR VIDEO</h4>
                        <div class="form-row">
                            <div class="form-uploader video_uploader wow fadeInUp" data-wow-delay="0.1s">
                                <div class="form-uploader-box">
                                    <svg width="115" height="82" viewBox="0 0 115 82" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M78.0357 82H8.21429C6.03572 82 3.94639 81.1361 2.40591 79.5983C0.865431 78.0605 0 75.9748 0 73.8V8.2C0 6.02522 0.865431 3.93952 2.40591 2.40172C3.94639 0.863926 6.03572 0 8.21429 0H78.0357C80.2143 0 82.3036 0.863926 83.8441 2.40172C85.3846 3.93952 86.25 6.02522 86.25 8.2V24.846L108.511 8.979C109.124 8.5433 109.845 8.28409 110.595 8.22967C111.346 8.17525 112.097 8.32771 112.767 8.6704C113.436 9.0131 113.999 9.53286 114.393 10.1729C114.786 10.813 114.997 11.5488 115 12.3V69.7C114.997 70.4512 114.786 71.187 114.393 71.8271C113.999 72.4671 113.436 72.9869 112.767 73.3296C112.097 73.6723 111.346 73.8248 110.595 73.7703C109.845 73.7159 109.124 73.4567 108.511 73.021L86.25 57.154V73.8C86.25 75.9748 85.3846 78.0605 83.8441 79.5983C82.3036 81.1361 80.2143 82 78.0357 82Z"
                                            fill="#373737" />
                                    </svg>
                                    <video class="video" id="video"></video>
                                    <div class="form-uploader-box-overlay" id="video_overlay">
                                        <div class="video-control" id="video_control">
                                            <p class="video-name"></p>
                                            <button type="button" class="clear-video" id="clear-video"><i
                                                    class="fas fa-window-close"></i></button>
                                        </div>
                                        <h5 class="form-uploader-box-title" id="uploading_content">Upload Your Video</h5>
                                        <input type="file" id="video_file" accept="video/*">
                                    </div>
                                </div>
                                <div class="form-uploader-progress-bar">
                                    <div class="progress-bar-thumb">
                                        <div class="progress-bar-scroll" id="progress_bar_scroll"></div>
                                    </div>
                                    <span class="progress-count" id="percent_text">0%</span>
                                </div>
                                <span class="error-text">Please choose video</span>
                            </div>
                            <div class="form-right">
                                <div class="form-field wow fadeInUp" data-wow-delay="0.1s">
                                    <label>Please share a link to the video</label>
                                    <input type="text" id="video_link" name="video_url">
                                    <span class="error-text">Please fill the field</span>
                                </div>
                                <div class="form-field wow fadeInUp" data-wow-delay="0.1s">
                                    <label>Kindly describe what happens in the video: (Recommended)</label>
                                    <textarea id="video_desc" name="description" class="md-textarea" required></textarea>
                                    <span class="error-text">Please fill the field</span>
                                </div>
                                <div class="form-field form-field-index wow fadeInUp" data-wow-delay="0.1s">
                                    <label>When did you film it?</label>
                                    <input type="text" id="film_date" name="when_filmed" class="calender-field flatpickr" required>
                                    <span class="error-text">Please fill the field</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row-half">
                            <div class="form-row-half-extra-spacing">
                                <h5 class="wow fadeInUp" data-wow-delay="0.1s">Where did you film the video?</h5>
                                <div class="form-row-half__row">
                                    <div class="form-col-6">
                                        <div class="form-field wow fadeInUp" data-wow-delay="0.1s">
                                            <label>City:</label>
                                            <input type="text" id="city" name="city" required>
                                            <span class="error-text">Please fill the field</span>
                                        </div>
                                    </div>
                                    <div class="form-col-6">
                                        <div class="form-field wow fadeInUp" data-wow-delay="0.1s">
                                            <label>State/Province/Region:</label>
                                            <input type="text" id="state" name="state" required>
                                            <span class="error-text">Please fill the field</span>
                                        </div>
                                    </div>
                                    <div class="form-col-6">
                                        <div class="form-field wow fadeInUp" data-wow-delay="0.1s">
                                            <label>Country:</label>
                                            <select name="country" id="country" required>
                                                <option value="0" selected="selected" disabled="">Select Country
                                                </option>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antarctica">Antarctica</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius
                                                    and
                                                    Saba</option>
                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Bouvet Island">Bouvet Island</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="British Indian Ocean Territory">British Indian Ocean
                                                    Territory
                                                </option>
                                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic</option>
                                                <option value="Chad">Chad</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos Islands">Cocos Islands</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo, Democratic Republic of the">Congo, Democratic
                                                    Republic of
                                                    the</option>
                                                <option value="Congo, Republic of the">Congo, Republic of the</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Curaçao">Curaçao</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Eswatini (Swaziland)">Eswatini (Swaziland)</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands">Falkland Islands</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="French Guiana">French Guiana</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="French Southern Territories">French Southern Territories
                                                </option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadeloupe">Guadeloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guernsey">Guernsey</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Heard and McDonald Islands">Heard and McDonald Islands
                                                </option>
                                                <option value="Holy See">Holy See</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran">Iran</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jersey">Jersey</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Lao People's Democratic Republic">Lao People's Democratic
                                                    Republic</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libya">Libya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macau">Macau</option>
                                                <option value="Macedonia">Macedonia</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Micronesia">Micronesia</option>
                                                <option value="Moldova">Moldova</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montenegro">Montenegro</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Namibia">Namibia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherlands">Netherlands</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="North Korea">North Korea</option>
                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau">Palau</option>
                                                <option value="Palestine, State of">Palestine, State of</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Pitcairn">Pitcairn</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russia">Russia</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="Réunion">Réunion</option>
                                                <option value="Saint Barthélemy">Saint Barthélemy</option>
                                                <option value="Saint Helena">Saint Helena</option>
                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                <option value="Saint Lucia">Saint Lucia</option>
                                                <option value="Saint Martin">Saint Martin</option>
                                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon
                                                </option>
                                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the
                                                    Grenadines</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Serbia">Serbia</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Sint Maarten">Sint Maarten</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="South Georgia">South Georgia</option>
                                                <option value="South Korea">South Korea</option>
                                                <option value="South Sudan">South Sudan</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen
                                                    Islands
                                                </option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syria">Syria</option>
                                                <option value="Taiwan">Taiwan</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania">Tanzania</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Timor-Leste">Timor-Leste</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tokelau">Tokelau</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="US Minor Outlying Islands">US Minor Outlying Islands
                                                </option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States">United States</option>
                                                <option value="Uruguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Vietnam">Vietnam</option>
                                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                <option value="Western Sahara">Western Sahara</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
                                                <option value="Åland Islands">Åland Islands</option>
                                            </select>
                                            <span class="error-text">Please fill the field</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-lists">
                        <div class="form-row-half">
                            <h4 class="wow fadeInUp" data-wow-delay="0.1s">TELL US MORE ABOUT YOURSELF</h4>
                            <label class="wow fadeInUp" data-wow-delay="0.1s">Your Full Name:</label>
                            <div class="form-row-half__row">
                                <div class="form-col-6">
                                    <div class="form-field wow fadeInUp" data-wow-delay="0.1s">
                                        <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                                        <span class="error-text">Please fill the field</span>
                                    </div>
                                </div>
                                <div class="form-col-6">
                                    <div class="form-field wow fadeInUp" data-wow-delay="0.1s">
                                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
                                        <span class="error-text">Please fill the field</span>
                                    </div>
                                </div>
                                <div class="form-col-6">
                                    <div class="form-field wow fadeInUp" data-wow-delay="0.1s">
                                        <label>Your Email Address:</label>
                                        <input required value="{{ old('email') }}" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email" id="email">
                                            <span class="text-danger" id="email_validation_message"></span>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        {{-- <span class="error-text">Please fill the valid email id</span> --}}
                                    </div>
                                </div>
                                <div class="form-col-6">
                                    <div class="form-field form-field-index wow fadeInUp" data-wow-delay="0.1s">
                                        <label>Your Date of Birth:</label>
                                        <input type="text" id="dob" class="calender-field flatpickr" name="birthdate" required>
                                        <span class="error-text">Please fill the field</span>
                                    </div>
                                </div>
                                <div class="form-col-6">
                                    <div class="form-field wow fadeInUp" data-wow-delay="0.1s">
                                        <label>Your Phone Number: (optional)</label>
                                        <input type="text" maxlength="10" id="phone_number" class="isNumber"
                                            onkeypress="return validateNumber(event)" name="phone">
                                    </div>
                                </div>
                                <div class="form-col-6">
                                    <div class="form-field wow fadeInUp" data-wow-delay="0.1s">
                                        <label>Your Social Media Handle: (optional)</label>
                                        <input type="text" id="social_media_handle" name="video_credit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-lists">
                        <h4 class="wow fadeInUp" data-wow-delay="0.1s">LET'S VERIFY THE COPYRIGHTS OWNERSHIP</h4>
                        <div class="form-row-half__row">
                            <div class="form-col-6">
                                <div class="left-form">
                                    <div class="form-field-extra-spacing wow fadeInUp" data-wow-delay="0.1s"
                                        id="form_field_appearing">
                                        <label>Are There People Appearing In The Video?</label>
                                        <div class="box-inline">
                                            <p>
                                                <input type="radio" id="video_appearing_yes" name="people_appearing"
                                                    value="yes" required>
                                                <label for="video_appearing_yes">Yes</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="video_appearing_no" name="people_appearing"
                                                    value="no" required>
                                                <label for="video_appearing_no">No</label>
                                            </p>
                                        </div>
                                        <div class="form-field" id="people_appearing">
                                            <label>Who Are They?</label>
                                            <input type="text" placeholder="Please mention them all"
                                                id="people_appearing_list" name="people_appearing_list">
                                            <span class="error-text">Please fill the field</span>
                                        </div>
                                        <span class="error-text">Please choose one</span>
                                    </div>
                                    <div class="form-field-extra-spacing wow fadeInUp" data-wow-delay="0.1s"
                                        id="submit_video_website">
                                        <label>Did You Send/Submit/Upload This Video To A Website And/Or Social Media
                                            Account?</label>
                                        <div class="box-inline" id="">
                                            <p>
                                                <input type="radio" id="video_website_a" name="submit_other_website"
                                                    value="No, I Did Not">
                                                <label for="video_website_a">No, I Did Not</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="video_website_b" name="submit_other_website"
                                                    value="Yes, Another Company's Website">
                                                <label for="video_website_b">Yes, Another Company's Website</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="video_website_c" name="submit_other_website"
                                                    value="Yes, A Facebook Page">
                                                <label for="video_website_c">Yes, A Facebook Page</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="video_website_d" name="submit_other_website"
                                                    value="Yes, A Twitter Account">
                                                <label for="video_website_d">Yes, A Twitter Account</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="video_website_e" name="submit_other_website"
                                                    value="Yes, An Instagram Account">
                                                <label for="video_website_e">Yes, An Instagram Account</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="video_website_f" name="submit_other_website"
                                                    value="Yes, A YouTube Channel">
                                                <label for="video_website_f">Yes, A YouTube Channel</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="video_website_g" name="submit_other_website"
                                                    value="Yes, A Snaphat Account">
                                                <label for="video_website_g">Yes, A Snaphat Account</label>
                                            </p>
                                        </div>
                                        <span class="error-text">Please choose one</span>
                                        <div class="form-field" id="submit_video_website_show">
                                            <label>Where Did You Submit It?</label>
                                            <input type="text" placeholder="Please list all the pages and websites"
                                                id="submit_place" name="submit_place" class="">
                                            <span class="error-text">Please fill the field</span>
                                        </div>
                                    </div>
                                    <div class="form-field-extra-spacing wow fadeInUp" data-wow-delay="0.1s"
                                        id="aggrement_with_another_company">
                                        <label>Did You Sign A Licensing Agreement For This Video With Another
                                            Company/Page?</label>
                                        <div class="box-inline" id="">
                                            <p>
                                                <input type="radio" id="licensing_agreement_a"
                                                    name="aggrement_with_another_company" value="No, I Did Not">
                                                <label for="licensing_agreement_a">No, I Did Not</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="licensing_agreement_b"
                                                    name="aggrement_with_another_company" value="Yes, I Have Filled An Online Form.">
                                                <label for="licensing_agreement_b">Yes, I Have Filled An Online
                                                    Form.</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="licensing_agreement_c"
                                                    name="aggrement_with_another_company"
                                                    value="Yes, I Have Signed An Exclusive Agreement.">
                                                <label for="licensing_agreement_c">Yes, I Have Signed An Exclusive
                                                    Agreement.</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="licensing_agreement_d"
                                                    name="aggrement_with_another_company"
                                                    value="Yes, I Have Signed A Non-Exclusive Agreement.">
                                                <label for="licensing_agreement_d">Yes, I Have Signed A Non-Exclusive
                                                    Agreement.</label>
                                            </p>
                                        </div>
                                        <span class="error-text">Please choose one</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-col-6">
                                <div class="right-form">
                                    <div class="form-field-extra-spacing wow fadeInUp" data-wow-delay="0.1s"
                                        id="person_who_filmed">
                                        <label>The Person Who Filmed This Video Is:</label>
                                        <div class="box-inline" id="">
                                            <p>
                                                <input type="radio" id="filmed_person_a" name="person_who_filmed"
                                                    value="Me">
                                                <label for="filmed_person_a">Me</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="filmed_person_b" name="person_who_filmed"
                                                    value="A Family Member">
                                                <label for="filmed_person_b">A Family Member</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="filmed_person_c" name="person_who_filmed"
                                                    value="A Friend">
                                                <label for="filmed_person_c">A Friend</label>
                                            </p>

                                            <p>
                                                <input type="radio" id="filmed_person_d" name="person_who_filmed"
                                                    value="Someone I Know">
                                                <label for="filmed_person_d">Someone I Know</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="filmed_person_f" name="person_who_filmed"
                                                    value="A Dashcam">
                                                <label for="filmed_person_f">A Dashcam</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="filmed_person_g" name="person_who_filmed"
                                                    value="A Security Camera">
                                                <label for="filmed_person_g">A Security Camera</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="filmed_person_h" name="person_who_filmed"
                                                    value="Other">
                                                <label for="filmed_person_h">Other</label>
                                            </p>
                                        </div>
                                        <span class="error-text">Please choose one</span>
                                        <div class="form-field-lg">
                                            <input type="text" id="other_filmed_person" class="lg-input" name="person_who_filmed_other">
                                            <span class="error-text">Please fill the field</span>
                                        </div>
                                    </div>
                                    <div class="form-field-extra-spacing wow fadeInUp" data-wow-delay="0.1s"
                                        id="did_anyone_reach">
                                        <label>Did Anyone Reach You About Using This Video?</label>
                                        <div class="box-inline" id="">
                                            <p>
                                                <input type="radio" id="reach_video_a" name="did_anyone_reach"
                                                    value="No, You Are The First Company">
                                                <label for="reach_video_a">No, You Are The First Company</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="reach_video_b" name="did_anyone_reach"
                                                    value="Yes, Another Company Contacted Me">
                                                <label for="reach_video_b">Yes, Another Company Contacted Me</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="reach_video_c" name="did_anyone_reach"
                                                    value="Yes, Some Social Media Accounts Messaged Me">
                                                <label for="reach_video_c">Yes, Some Social Media Accounts Messaged
                                                    Me</label>
                                            </p>
                                        </div>
                                        <span class="error-text">Please choose one</span>
                                        <div class="form-field" id="did_anyone_reach_show">
                                            <label>Please Share With Us The Name Of The Company/Page:</label>
                                            <input type="text" placeholder="Please list all the pages and websites"
                                                id="share_reach_name" name="share_reach_name">
                                            <span class="error-text">Please fill the field</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-col-12">
                                <div class="let-line">
                                    <div class="legal-cal">
                                        <div class="box-inline-check-box" id="">
                                            <div class="form-lg wow fadeInUp" data-wow-delay="0.1s">
                                                <p>
                                                    <input type="checkbox" id="licensing_agreement_legal_a"
                                                        name="yes_a"
                                                        value="Yes, I Have Read And Agreed To The Terms of Service">
                                                    <label for="licensing_agreement_legal_a">Yes, I Have Read And Agreed To
                                                        The <a href="Javascript:void(0);" data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop" class="legal_btn">Terms of
                                                            Service</a></label>
                                                    <span class="error-text">Please accept terms of service</span>
                                                </p>
                                            </div>
                                            <div class="form-lg wow fadeInUp" data-wow-delay="0.1s">
                                                <p>
                                                    <input type="checkbox" id="licensing_agreement_legal_b"
                                                        name="yes_b"
                                                        value="Yes, I Have Read And Agreed To Terms of Submission">
                                                    <label for="licensing_agreement_legal_b">Yes, I Have Read And Agreed To
                                                        <a href="Javascript:void(0);" data-bs-toggle="modal"
                                                            data-bs-target="#staticSubmission" class="legal_btn">Terms of
                                                            Submission</a></label>
                                                    <span class="error-text">Please accept terms of submission</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-field-signature wow fadeInUp" data-wow-delay="0.1s">
                                        <label>Your Digital Signature</label>
                                        <div class="digital-signature-wrap">
                                            <div class="digital-signature" id="digital_signature">
                                                <canvas id="sig-canvas">
                                                    Get a better browser, bro.
                                                </canvas>
                                            </div>
                                            <button type="button" class="btn btn-default" id="sig-clearBtn"><i
                                                    class="fas fa-sync-alt"></i></button>
                                            <textarea id="sig-dataUrl" class="form-control" rows="5" name="signature"></textarea>
                                            <span class="error-text">Please enter valid signature</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-col-12">
                                <div class="form-btn wow fadeInUp" data-wow-delay="0.1s">
                                    <button type="submit" id="submit_button" class="page-btn page-btn-primary"><span>Send your video</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="video" id="final_video">
                </form>
            </div>
        </div>
        <div class="landing-left-graphics wow fadeInLeft" data-wow-delay="0.1s">
            <img src="{{asset('images/left-graphics.png')}}" alt="">
        </div>
    </div>
@stop
@section('javascript')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    let percentText = document.getElementById('percent_text');
    let progressBarScroll = document.getElementById('progress_bar_scroll');
    let videoFile = document.querySelector('#video_file');
    let video = document.querySelector('#video');
    let videoSource = document.createElement('source');
    videoFile.onchange = function () {
      let data = new FormData();
      data.append('video', videoFile.files[0]);
      let config = {
        onUploadProgress: function(progressEvent) {
            let percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
            percentText.innerHTML = percentCompleted+"%";
            progressBarScroll.style.width = percentCompleted+"%";
            document.getElementById('uploading_content').innerHTML = 'Uploading please wait...';
        }
      };

      axios.post('{{route('progressbar')}}', data, config)
        .then(function (res) {
            //console.log(res)

              document.querySelector('.video-name').innerHTML = videoFile.files[0].name;
             document.getElementById('uploading_content').style.display = 'none';
             videoFile.style.display = 'none';
             document.getElementById('video_control').style.opacity = "1";
             //$('#video').val(res.data)
              videoSource.setAttribute('src',`https://vsclips.s3.us-east-2.amazonaws.com/`+ res.data);
             //videoSource.setAttribute('src',`http://mototubesubmission.test/storage/`+ res.data);
            video.appendChild(videoSource);
            video.load();
            video.play();
            video.style.display = 'block';
            document.getElementById("final_video").value = res.data;
        })
        .catch(function (err) {
         //  output.className = 'container text-danger';
         //  output.innerHTML = err.message;
        });
    };
  document.getElementById('clear-video').addEventListener('click', function(){
    videoFile.value = "";
    document.querySelector('.video-name').innerHTML = "";
    document.getElementById('video_control').style.opacity = "0";
    document.getElementById('progress_bar_scroll').style.width = "0%";
    document.getElementById('percent_text').innerHTML = "0%";
    videoFile.style.display = 'block';
    document.getElementById('uploading_content').innerHTML = 'Upload Your Video';
    videoSource.remove();
    video.load();
    video.style.display = 'none';
    document.getElementById('uploading_content').style.display = 'flex';
  })
</script>

<script>
    $(document).ready(function() {
      $('#email').blur(function() {

        var email = $(this).val();
        var email_validation_message = $('#email_validation_message');
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(email)) {
          $('#email_validation_message').text('Please enter a valid email address');
        } else {
          $.ajax({
            url: '{{route('validate.email')}}',
            method: 'GET',
            data: { email: email },
            dataType: 'json',
            contentType: 'application/json',
            success: function(response) {
                email_validation_message.text('');
                $('#submit_button').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                email_validation_message.text('The email you entered does not exist. Please enter a valid email address')
                alert('The email you entered does not exist. Please enter a valid email address');
                $('#submit_button').prop('disabled', true);
            }
          });
        }
      });
      $('#email').keyup(function() {
        $('#email_validation_message').text('');
      });
    });
    
    </script>
@stop
