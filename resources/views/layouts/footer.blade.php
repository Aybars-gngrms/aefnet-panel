
</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('backend') }}/assets/js/core/popper.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/core/bootstrap-material-design.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

<script src="{{ asset('backend') }}/assets/js/plugins/sweetalert2.js"></script>


<script src="{{ asset('backend') }}/assets/js/plugins/bootstrap-tagsinput.js"></script>

<script src="{{ asset('backend') }}/assets/js/plugins/jasny-bootstrap.min.js"></script>

<script src="{{ asset('backend') }}/assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/plugins/fullcalendar/daygrid.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/plugins/fullcalendar/timegrid.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/plugins/fullcalendar/list.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/plugins/fullcalendar/interaction.min.js"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<script src="{{ asset('backend') }}/assets/js/material-dashboard.min.js" type="text/javascript"></script>

<script src="{{ asset('backend') }}/assets/js/plugins/bootstrap-selectpicker.js"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $('#datatables').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Arama . . .",
      }

    });

</script>

<script>
    function cevir() {
      var input = document.getElementById("player_nick");
      var value = input.value;
      var trChars = ["ğ", "Ğ", "ü", "Ü", "ş", "Ş", "ı", "İ", "ö", "Ö", "ç", "Ç"];
      var enChars = ["g", "G", "u", "U", "s", "S", "i", "I", "o", "O", "c", "C"];
      for (var i = 0; i < trChars.length; i++) {
        value = value.replace(new RegExp(trChars[i], "g"), enChars[i]);
      }
      input.value = value;
    }

</script>

@stack('scripts')
@livewireScripts
</body>
</html>
