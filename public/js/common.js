// date picker
const flatpickrExits = document.getElementsByClassName('flatpickr').length > 0;
if(flatpickrExits) {
  flatpickr('.flatpickr', {
    dateFormat: "d/m/Y",
  })
}


// digital signature
const getSignatureExits = document.getElementsByClassName('digital-signature').length > 0;
if(getSignatureExits) {
  (function() {
    window.requestAnimFrame = (function(callback) {
      return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimaitonFrame ||
        function(callback) {
          window.setTimeout(callback, 1000 / 60);
        };
    })();

    var canvas = document.getElementById("sig-canvas");
    var ctx = canvas.getContext("2d");
    ctx.strokeStyle = "#727272";
    ctx.lineWidth = 4;

    var drawing = false;
    var mousePos = {
      x: 0,
      y: 0
    };
    var lastPos = mousePos;

    canvas.addEventListener("mousedown", function(e) {
      drawing = true;
      lastPos = getMousePos(canvas, e);
    }, false);

    canvas.addEventListener("mouseup", function(e) {
      drawing = false;
    }, false);

    canvas.addEventListener("mousemove", function(e) {
      mousePos = getMousePos(canvas, e);
    }, false);

    // Add touch event support for mobile
    canvas.addEventListener("touchstart", function(e) {
      document.body.style.overflow = "hidden";
      document.querySelector('html').style.overflow = "hidden";
    }, false);
    canvas.addEventListener("touchend", function(e) {
      document.body.style.overflow = "auto";
      document.querySelector('html').style.overflow = "auto";
    }, false);

    canvas.addEventListener("touchmove", function(e) {
      var touch = e.touches[0];
      var me = new MouseEvent("mousemove", {
        clientX: touch.clientX,
        clientY: touch.clientY
      });
      canvas.dispatchEvent(me);
    }, false);

    canvas.addEventListener("touchstart", function(e) {
      mousePos = getTouchPos(canvas, e);
      var touch = e.touches[0];
      var me = new MouseEvent("mousedown", {
        clientX: touch.clientX,
        clientY: touch.clientY
      });
      canvas.dispatchEvent(me);
    }, false);

    canvas.addEventListener("touchend", function(e) {
      var me = new MouseEvent("mouseup", {});
      canvas.dispatchEvent(me);
    }, false);

    function getMousePos(canvasDom, mouseEvent) {
      var rect = canvasDom.getBoundingClientRect();
      return {
        x: mouseEvent.clientX - rect.left,
        y: mouseEvent.clientY - rect.top
      }
    }

    function getTouchPos(canvasDom, touchEvent) {
      var rect = canvasDom.getBoundingClientRect();
      return {
        x: touchEvent.touches[0].clientX - rect.left,
        y: touchEvent.touches[0].clientY - rect.top
      }
    }

    function renderCanvas() {
      if (drawing) {
        ctx.beginPath();
        ctx.moveTo(lastPos.x, lastPos.y);
        ctx.lineTo(mousePos.x, mousePos.y);
        ctx.stroke();
        lastPos = mousePos;
      }else {
        ctx.closePath();
      }
    }

    // Prevent scrolling when touching the canvas
    document.body.addEventListener("touchstart", function(e) {
      if (e.target == canvas) {
        e.preventDefault();
      }
    }, {passive:false});
    document.body.addEventListener("touchend", function(e) {
      if (e.target == canvas) {
        e.preventDefault();
      }
    }, {passive:false});
    document.body.addEventListener("touchmove", function(e) {
      if (e.target == canvas) {
        e.preventDefault();
      }
    }, {passive:false});

    (function drawLoop() {
      requestAnimFrame(drawLoop);
      renderCanvas();
    })();

    function clearCanvas() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    // Set up the UI
    var sigText = document.getElementById("sig-dataUrl");
    var clearBtn = document.getElementById("sig-clearBtn");
    clearBtn.addEventListener("click", function(e) {
      clearCanvas();
      drawing = false;
      sigText.innerHTML = "";
    }, false);

    canvas.addEventListener('click', function(e){
	  	var dataUrl = canvas.toDataURL();
	    sigText.innerHTML = dataUrl;
      document.getElementById('sig-dataUrl').parentElement.classList.remove("error");
      document.getElementById('sig-dataUrl').classList.remove('invalid');
	  })

  })();
}

// video uploader progreassbar
// let videoProgressBar = (percentage,percentDuration) => {
//   var percentText = document.getElementById('percent_text');
//   var progressBarScroll = document.getElementById('progress_bar_scroll');
//   if(percentage<=100){
//     let current = 0,
//     range = percentage - 0,
//     increment = percentage > 0 ? 1 : -1,
//     step = Math.abs(Math.floor(percentDuration / range)),
//     timer = setInterval(() => {
//         current += increment;
//         percentText.innerHTML = current+"%";
//         progressBarScroll.style.width = current+"%";
//         if (current == percentage) {
//           clearInterval(timer);
//           document.getElementById('uploading_content').innerHTML = 'Uploaded Your Video';
//           // setTimeout(() => {
//           //   document.getElementById('uploading_content').innerHTML = 'Replace your video';
//           // }, 1000);
//           document.getElementById('uploading_content').style.display = 'none';
//         }
//     }, step);
//   }
// }

// // choose video file
// const getVideoUploaderExists = document.getElementsByClassName('video_uploader').length > 0;
// if(getVideoUploaderExists) {
//   const videoFile = document.querySelector('#video_file');
//   const videoOverlay = document.getElementById("video_overlay");
//   const video = document.querySelector('#video');
//   const videoSource = document.createElement('source');
//   document.getElementById('video_control').style.opacity = "0";
//   videoFile.addEventListener('change', function() {
//     document.getElementById('uploading_content').innerHTML = 'Uploading please wait...';
//     videoProgressBar(100,4000);
//     setTimeout(() => {
//     const files = videoFile.files || [];
//     var videoName = videoFile.files[0].name;
//     videoOverlay.classList.add('active');
//       if (!files.length) return;
//       const reader = new FileReader();
//       reader.onload = function (e) {
//           videoSource.setAttribute('src', e.target.result);
//           video.appendChild(videoSource);
//           video.load();
//           video.play();
//           video.style.display = 'block';
//           video.classList.add("active");
//           videoFile.style.display = 'none';
//           console.log(videoName);
//           document.querySelector('.video-name').innerHTML = videoName;
//           document.getElementById('video_control').style.opacity = "1";
//       };
//       reader.readAsDataURL(files[0]);
//     },4000)
//   })

//   document.getElementById('clear-video').addEventListener('click', function(){
//     videoFile.value = "";
//     document.querySelector('.video-name').innerHTML = "";
//     document.getElementById('video_control').style.opacity = "0";
//     document.getElementById('progress_bar_scroll').style.width = "0%";
//     document.getElementById('percent_text').innerHTML = "0%";
//     videoFile.style.display = 'block';
//     document.getElementById('uploading_content').innerHTML = 'Upload Your Video';
//     videoSource.remove();
//     video.load();
//     video.style.display = 'none';
//     document.getElementById('uploading_content').style.display = 'flex';
//   })
// }
// form validation
const getFormExists = document.getElementsByClassName('form_exists').length > 0;
if(getFormExists) {
  let videoFile = document.getElementById('video_file');
  let videoDesc = document.getElementById('video_desc');
  let filmDate = document.getElementById('film_date');
  let city = document.getElementById('city');
  let state = document.getElementById('state');
  let country = document.getElementById('country');
  let firstName = document.getElementById('first_name');
  let lastName = document.getElementById('last_name');
  let email = document.getElementById('email');
  let dob = document.getElementById('dob');
  let phoneNumber = document.getElementById('phone_number');
  let socialMediaHandle = document.getElementById('social_media_handle');
  let sigDataUrl = document.getElementById('sig-dataUrl');
  let legalService = document.getElementById('licensing_agreement_legal_a');
  let legalSubmission = document.getElementById('licensing_agreement_legal_b');

  let peopleAppearingList = document.getElementById('people_appearing_list');
  var selectErrorAppearing = document.getElementById("form_field_appearing");
  var selectedAppearingVideoItems = document.querySelectorAll('#form_field_appearing input[type="radio"]:checked');
  let video_appearing_count = 0;
  let video_appearing_count_text = 0;

  let otherFilmedPerson = document.getElementById('other_filmed_person');
  var personWhoFilmed = document.getElementById("person_who_filmed");
  var selectedPersonWhoFilmedItems = document.querySelectorAll('#person_who_filmed input[type="radio"]:checked');
  let person_who_filmed_count = 0;
  let person_who_filmed_count_text = 0;
  otherFilmedPerson.style.display = 'none';

  let submitPlace = document.getElementById('submit_place');
  var submitVideoWebsite = document.getElementById("submit_video_website");
  var selectedsubmitVideoWebsiteItems = document.querySelectorAll('#submit_video_website input[type="radio"]:checked');
  let submit_video_website_count = 0;
  let submit_video_website_count_text = 0;

  let shareReachName = document.getElementById('share_reach_name');
  var didAnyoneReach = document.getElementById("did_anyone_reach");
  var selectedShareReachNameItems = document.querySelectorAll('#did_anyone_reach input[type="radio"]:checked');
  let share_reach_name_count = 0;
  let share_reach_name_count_text = 0;

  let aggrementWithAnotherCompany = document.getElementById('aggrement_with_another_company');
  let selectedAggrementWithAnotherCompanyItem = document.querySelectorAll('#did_anyone_reach input[type="radio"]:checked');
  let aggrement_with_another_company_count = 0;




  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  function validateNumber(e) {
    const pattern = /^[0-9]$/;
    return pattern.test(e.key )
  }

  videoFile.addEventListener('input', function handleChange(event) {
    videoFile.classList.remove('invalid');
    videoFile.parentElement.parentElement.parentElement.classList.remove("error");
  })

  videoDesc.addEventListener('input', function handleChange(event) {
    videoDesc.classList.remove('invalid');
    videoDesc.parentElement.classList.remove("error");
  })
  filmDate.addEventListener('change', function handleChange(event) {
    filmDate.classList.remove('invalid');
    filmDate.parentElement.parentElement.classList.remove("error");
  })
  city.addEventListener('input', function handleChange(event) {
    city.classList.remove('invalid');
    city.parentElement.classList.remove("error");
  })
  state.addEventListener('input', function handleChange(event) {
    state.classList.remove('invalid');
    state.parentElement.classList.remove("error");
  })
  country.addEventListener('input', function handleChange(event) {
    country.classList.remove('invalid');
    country.parentElement.classList.remove("error");
  })
  firstName.addEventListener('input', function handleChange(event) {
    firstName.classList.remove('invalid');
    firstName.parentElement.classList.remove("error");
  })
  lastName.addEventListener('input', function handleChange(event) {
    lastName.classList.remove('invalid');
    lastName.parentElement.classList.remove("error");
  })
  email.addEventListener('input', function handleChange(event) {
    email.classList.remove('invalid');
    email.parentElement.classList.remove("error");
  })
  dob.addEventListener('change', function handleChange(event) {
    dob.classList.remove('invalid');
    dob.parentElement.parentElement.classList.remove("error");
  })
  peopleAppearingList.addEventListener('input', function handleChange(event) {
    peopleAppearingList.classList.remove('invalid');
    peopleAppearingList.parentElement.classList.remove("error");
  })
  otherFilmedPerson.addEventListener('input', function handleChange(event) {
    otherFilmedPerson.classList.remove('invalid');
    otherFilmedPerson.parentElement.classList.remove("error");
  })
  submitPlace.addEventListener('input', function handleChange(event) {
    submitPlace.classList.remove('invalid');
    submitPlace.parentElement.classList.remove("error");
  })
  shareReachName.addEventListener('input', function handleChange(event) {
    shareReachName.classList.remove('invalid');
    shareReachName.parentElement.classList.remove("error");
  })
  legalService.addEventListener('change', function handleChange(event) {
    legalService.parentElement.classList.remove("error");
  })
  legalSubmission.addEventListener('change', function handleChange(event) {
    legalSubmission.parentElement.classList.remove("error");
  })


  document.querySelectorAll('#form_field_appearing input[type="radio"]').forEach((dataInput) => {
    document.getElementById('people_appearing').style.display = 'none';
    dataInput.addEventListener('change', function(){
      video_appearing_count = 1;
      selectErrorAppearing.classList.remove("error");
      if(this.value === 'yes') {
        video_appearing_count_text = 1;
        document.getElementById('people_appearing').style.display = 'block';
      }else{
        video_appearing_count_text = 0;
        document.getElementById('people_appearing').style.display = 'none';
        peopleAppearingList.parentElement.classList.remove("error");
        peopleAppearingList.value = "";
      }
    });
  });
  document.querySelectorAll('#person_who_filmed input[type="radio"]').forEach((dataInput) => {
    dataInput.addEventListener('change', function(){
      person_who_filmed_count = 1;
      personWhoFilmed.classList.remove("error");
      if(this.value === 'Other') {
        person_who_filmed_count_text = 1;
        otherFilmedPerson.style.display = "block";
      }else{
        person_who_filmed_count_text = 0;
        otherFilmedPerson.parentElement.classList.remove("error");
        otherFilmedPerson.style.display = "none";
        otherFilmedPerson.value = "";
      }
    });
  });
  document.querySelectorAll('#submit_video_website input[type="radio"]').forEach((dataInput) => {
    document.getElementById('submit_video_website_show').style.display = 'none';
    dataInput.addEventListener('change', function(){
      submit_video_website_count = 1;
      submitVideoWebsite.classList.remove("error");
      if(this.value != 'No, I Did Not') {
        submit_video_website_count_text = 1;
        document.getElementById('submit_video_website_show').style.display = 'block';
      }else{
        submit_video_website_count_text = 0;
        document.getElementById('submit_video_website_show').style.display = 'none';
        submitPlace.parentElement.classList.remove("error");
        submitPlace.value = "";
      }
    });
  });
  document.querySelectorAll('#did_anyone_reach input[type="radio"]').forEach((dataInput) => {
    document.getElementById('did_anyone_reach_show').style.display = 'none';
    dataInput.addEventListener('change', function(){
      share_reach_name_count = 1;
      didAnyoneReach.classList.remove("error");
      if(this.value != 'No, You Are The First Company') {
        share_reach_name_count_text = 1;
        document.getElementById('did_anyone_reach_show').style.display = 'block';
      }else{
        share_reach_name_count_text = 0;
        document.getElementById('did_anyone_reach_show').style.display = 'none';
        submitPlace.parentElement.classList.remove("error");
        shareReachName.value = "";
      }
    });
  });
  document.querySelectorAll('#aggrement_with_another_company input[type="radio"]').forEach((dataInput) => {
    dataInput.addEventListener('change', function(){
      aggrement_with_another_company_count = 1;
      aggrementWithAnotherCompany.classList.remove("error");
    });
  });



//   function isValidate() {
//     var valid = true;
//     if(videoFile.value == "") {
//       videoFile.className += " invalid";
//       videoFile.parentElement.parentElement.parentElement.classList.add("error");
//       valid = false;
//     }if(videoDesc.value == "") {
//       videoDesc.className += " invalid";
//       videoDesc.parentElement.classList.add("error");
//       valid = false;
//     }if(filmDate.value == "") {
//       filmDate.className += " invalid";
//       filmDate.parentElement.parentElement.classList.add("error");
//       valid = false;
//     }if(city.value == "") {
//       city.className += " invalid";
//       city.parentElement.classList.add("error");
//       valid = false;
//     }if(state.value == "") {
//       state.className += " invalid";
//       state.parentElement.classList.add("error");
//       valid = false;
//     }if(country.value == "0") {
//       country.className += " invalid";
//       country.parentElement.classList.add("error");
//       valid = false;
//     }if(firstName.value == "") {
//       firstName.className += " invalid";
//       firstName.parentElement.classList.add("error");
//       valid = false;
//     }if(lastName.value == "") {
//       lastName.className += " invalid";
//       lastName.parentElement.classList.add("error");
//       valid = false;
//     }if(email.value == "") {
//       email.className += " invalid";
//       email.parentElement.classList.add("error");
//       valid = false;
//     }if(!email.value.match(mailformat)) {
//       email.className += " invalid";
//       email.parentElement.classList.add("error");
//       valid = false;
//     }if(dob.value == "") {
//       dob.className += " invalid";
//       dob.parentElement.parentElement.classList.add("error");
//       valid = false;
//     }if(sigDataUrl.value == "") {
//       sigDataUrl.className += " invalid";
//       sigDataUrl.parentElement.classList.add("error");
//       valid = false;
//     }if(video_appearing_count === 0) {
//       selectErrorAppearing.classList.add("error");
//       valid = false;
//     }if(video_appearing_count_text === 1) {
//       if(peopleAppearingList.value == "") {
//         peopleAppearingList.className += " invalid";
//         peopleAppearingList.parentElement.classList.add("error");
//         valid = false;
//       }
//     }if(person_who_filmed_count === 0) {
//       personWhoFilmed.classList.add("error");
//       valid = false;
//     }if(person_who_filmed_count_text === 1) {
//       if(otherFilmedPerson.value == "") {
//         otherFilmedPerson.className += " invalid";
//         otherFilmedPerson.parentElement.classList.add("error");
//         valid = false;
//       }
//     }if(submit_video_website_count === 0) {
//       submitVideoWebsite.classList.add("error");
//       valid = false;
//     }if(submit_video_website_count_text === 1) {
//       if(submitPlace.value == "") {
//         submitPlace.className += " invalid";
//         submitPlace.parentElement.classList.add("error");
//         valid = false;
//       }
//     }if(share_reach_name_count === 0) {
//       didAnyoneReach.classList.add("error");
//       valid = false;
//     }if(share_reach_name_count_text === 1) {
//       if(shareReachName.value == "") {
//         shareReachName.className += " invalid";
//         shareReachName.parentElement.classList.add("error");
//         valid = false;
//       }
//     }if(aggrement_with_another_company_count == 0) {
//       aggrementWithAnotherCompany.classList.add("error");
//       valid = false;
//     }if(legalService.checked != true) {
//       legalService.parentElement.classList.add('error');
//       valid = false;
//     }if(legalSubmission.checked != true) {
//       legalSubmission.parentElement.classList.add('error');
//       valid = false;
//     }
//     return valid;
//   }

//   function handleVideoSubmit(){
//     if(!isValidate()) return false;
//     document.getElementById("submit_form").submit();
//   }
}

const getModalExists = document.getElementsByClassName('legal_btn').length > 0;
if(getModalExists) {
  document.querySelectorAll('.legal_btn').forEach((btnData) => {
    btnData.addEventListener('click', function(){
        document.querySelector('html').classList.add('modal-open_active');
    });
  });
  document.querySelectorAll('.btn-close').forEach((btnDataClose) => {
    btnDataClose.addEventListener('click', function(){
        document.querySelector('html').classList.remove('modal-open_active');
    });
  });
}
const getWowExists = document.getElementsByClassName('wow').length > 0;
if (getWowExists) {
  (function() {
    var Util,
      __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

    Util = (function() {
      function Util() {}

      Util.prototype.extend = function(custom, defaults) {
        var key, value;
        for (key in custom) {
          value = custom[key];
          if (value != null) {
            defaults[key] = value;
          }
        }
        return defaults;
      };

      Util.prototype.isMobile = function(agent) {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(agent);
      };

      return Util;

    })();

    this.WOW = (function() {
      WOW.prototype.defaults = {
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 0,
        mobile: true
      };

      function WOW(options) {
        if (options == null) {
          options = {};
        }
        this.scrollCallback = __bind(this.scrollCallback, this);
        this.scrollHandler = __bind(this.scrollHandler, this);
        this.start = __bind(this.start, this);
        this.scrolled = true;
        this.config = this.util().extend(options, this.defaults);
      }

      WOW.prototype.init = function() {
        var _ref;
        this.element = window.document.documentElement;
        if ((_ref = document.readyState) === "interactive" || _ref === "complete") {
          return this.start();
        } else {
          return document.addEventListener('DOMContentLoaded', this.start);
        }
      };

      WOW.prototype.start = function() {
        var box, _i, _len, _ref;
        this.boxes = this.element.getElementsByClassName(this.config.boxClass);
        if (this.boxes.length) {
          if (this.disabled()) {
            return this.resetStyle();
          } else {
            _ref = this.boxes;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
              box = _ref[_i];
              this.applyStyle(box, true);
            }
            window.addEventListener('scroll', this.scrollHandler, false);
            window.addEventListener('resize', this.scrollHandler, false);
            return this.interval = setInterval(this.scrollCallback, 50);
          }
        }
      };

      WOW.prototype.stop = function() {
        window.removeEventListener('scroll', this.scrollHandler, false);
        window.removeEventListener('resize', this.scrollHandler, false);
        if (this.interval != null) {
          return clearInterval(this.interval);
        }
      };

      WOW.prototype.show = function(box) {
        this.applyStyle(box);
        return box.className = "" + box.className + " " + this.config.animateClass;
      };

      WOW.prototype.applyStyle = function(box, hidden) {
        var delay, duration, iteration;
        duration = box.getAttribute('data-wow-duration');
        delay = box.getAttribute('data-wow-delay');
        iteration = box.getAttribute('data-wow-iteration');
        return box.setAttribute('style', this.customStyle(hidden, duration, delay, iteration));
      };

      WOW.prototype.resetStyle = function() {
        var box, _i, _len, _ref, _results;
        _ref = this.boxes;
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          box = _ref[_i];
          _results.push(box.setAttribute('style', 'visibility: visible;'));
        }
        return _results;
      };

      WOW.prototype.customStyle = function(hidden, duration, delay, iteration) {
        var style;
        style = hidden ? "visibility: hidden; -webkit-animation-name: none; -moz-animation-name: none; animation-name: none;" : "visibility: visible;";
        if (duration) {
          style += "-webkit-animation-duration: " + duration + "; -moz-animation-duration: " + duration + "; animation-duration: " + duration + ";";
        }
        if (delay) {
          style += "-webkit-animation-delay: " + delay + "; -moz-animation-delay: " + delay + "; animation-delay: " + delay + ";";
        }
        if (iteration) {
          style += "-webkit-animation-iteration-count: " + iteration + "; -moz-animation-iteration-count: " + iteration + "; animation-iteration-count: " + iteration + ";";
        }
        return style;
      };

      WOW.prototype.scrollHandler = function() {
        return this.scrolled = true;
      };

      WOW.prototype.scrollCallback = function() {
        var box;
        if (this.scrolled) {
          this.scrolled = false;
          this.boxes = (function() {
            var _i, _len, _ref, _results;
            _ref = this.boxes;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
              box = _ref[_i];
              if (!(box)) {
                continue;
              }
              if (this.isVisible(box)) {
                this.show(box);
                continue;
              }
              _results.push(box);
            }
            return _results;
          }).call(this);
          if (!this.boxes.length) {
            return this.stop();
          }
        }
      };

      WOW.prototype.offsetTop = function(element) {
        var top;
        top = element.offsetTop;
        while (element = element.offsetParent) {
          top += element.offsetTop;
        }
        return top;
      };

      WOW.prototype.isVisible = function(box) {
        var bottom, offset, top, viewBottom, viewTop;
        offset = box.getAttribute('data-wow-offset') || this.config.offset;
        viewTop = window.pageYOffset;
        viewBottom = viewTop + this.element.clientHeight - offset;
        top = this.offsetTop(box);
        bottom = top + box.clientHeight;
        return top <= viewBottom && bottom >= viewTop;
      };

      WOW.prototype.util = function() {
        return this._util || (this._util = new Util());
      };

      WOW.prototype.disabled = function() {
        return !this.config.mobile && this.util().isMobile(navigator.userAgent);
      };

      return WOW;

    })();

  }).call(this);


  wow = new WOW(
    {
      animateClass: 'animated',
      offset: 100
    }
  );
  wow.init();
}
