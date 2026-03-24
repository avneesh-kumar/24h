import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

toastr.options = {
  "closeButton": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "timeOut": "4000",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

window.toastr = toastr;