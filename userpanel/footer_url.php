<!--   Core JS Files   -->

    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

      <script src="assets/js/plugins/sweetalert.min.js"></script>
      <script src="assets/js/plugins/action.js"></script>

  <!-- Kanban scripts -->
    <script src="assets/js/plugins/dragula/dragula.min.js"></script>
    <script src="assets/js/plugins/jkanban/jkanban.js"></script>

    <script src="assets/js/plugins/chartjs.min.js"></script>
    <script src="assets/js/plugins/threejs.js"></script>
    <script src="assets/js/plugins/orbit-controls.js"></script>
    <script src="assets/js/plugins/dash.js"></script>
    <script src="assets/js/plugins/apexcharts.min.js"></script>
    <script src="assets/js/plugins/vmap/jquery.vmap.min.js"></script>
    <script src="assets/js/plugins/vmap/jquery.vmap.world.js"></script>
    <script src="https://reapbucks.com/assets/libs/sweetalert2/sweetalert2.min.js"></script>
  
    <script>

        $('#dynamic_select').on('change', function () {
            var url = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location = url; // redirect
            }
            return false;
        });


        $(document).ready(function () {

            $('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: 'transparent',
                color: 'rgba(120, 130, 140, .1)',
                borderColor: 'transparent',
                scaleColors: ["#d2e1f3", "#206bc4"],
                normalizeFunction: 'polynomial',

                values: (chart_data = {
                    in: 0, in: 0, us: 0, in: 0, in: 0, in: 0, in: 0, in: 0, in: 0, in: 0, in: 0, in: 0, bd: 0, sg: 0, bd: 0, pk: 0, sg: 0, in: 0, bd: 0, ke: 0, sy: 0, bd: 0, in: 0, in: 0, pk: 0, in: 0, in: 0, eg: 0, vn: 0, pk: 0, us: 0, bd: 0, in: 0, do: 0, eg: 0, gb: 0, in: 0, bd: 0, do: 0, bd: 0, in: 0, np: 0, np: 0, eg: 0, sg: 0, in: 0, pk: 0, in: 0, bd: 0, in: 0, in: 0, br: 0, bd: 0, in: 0, in: 0, us: 0, ci: 0, ma: 0, pk: 0, eg: 0, tr: 0, us: 0, np: 0, in: 0, pk: 0, bd: 0, bd: 0, bd: 0, sg: 0, in: 0, in: 0, bd: 0, in: 0, eg: 0, in: 0, gb: 0, bd: 0, pk: 0, in: 0, ci: 0, ma: 0, iq: 0, gb: 0, pk: 0, bd: 0, bd: 0, in: 0, bd: 0, bd: 0, eg: 0, eg: 0, bd: 0, eg: 0, eg: 0, eg: 0, pk: 0, bd: 0, eg: 0, in: 0, bd: 0, bd: 0, eg: 0, do: 0, eg: 0, eg: 0, bd: 0, np: 0, pk: 0, bd: 0, bd: 0, bd: 0, eg: 0, bd: 0, br: 0, in: 0, eg: 0, us: 0, eg: 0, eg: 0, eg: 0, eg: 0, bd: 0, in: 0, bd: 0, eg: 0, eg: 0, ma: 0, eg: 0, co: 0, us: 0, eg: 0, us: 0, eg: 0, eg: 0, tr: 0, ci: 0, bd: 0, bd: 0, eg: 0, in: 0, pk: 0, gb: 0, vn: 0, in: 0, do: 0, us: 0, fr: 0, bd: 0, ph: 0, ec: 0, eg: 0, eg: 0, in: 0, us: 0, bd: 0, pk: 0, es: 0, vn: 0, np: 0, in: 0, in: 0, in: 0, ng: 0, pk: 0, eg: 0, bd: 0, bd: 0, in: 0, in: 0, az: 0, ve: 0, bd: 0, do: 0, in: 0, in: 0, ng: 0, pk: 0, in: 0, us: 0, pk: 0, in: 0, ma: 0, in: 0, bd: 0, bd: 0, bd: 0, eg: 0, in: 0, in: 0, lb: 0, az: 0, in: 0, gb: 0, lb: 0, pk: 0, bd: 0, bd: 0, ru: 0, ru: 0, ma: 0, ae: 0, bd: 0, in: 0, in: 0, in: 0, in: 0, mk: 0, bd: 0, bd: 0, in: 0, gb: 0, ae: 0, eg: 0, tn: 0, bd: 0, in: 0, in: 0, pk: 0, us: 0, mk: 0, eg: 0, ci: 0, us: 0, vn: 0, in: 0, bd: 0, gb: 0, in: 0, bd: 0, pk: 0, in: 0, bd: 0, in: 0, in: 0, bd: 0, in: 0, bh: 0, mk: 0, bd: 0, eg: 0, in: 0, in: 0, pk: 0, in: 0, bd: 0, se: 0, in: 0, us: 0, dz: 0, do: 0, pk: 0, ng: 0, in: 0, bd: 0, in: 0, bd: 0, in: 0, in: 0, bd: 0, in: 0, in: 0, gb: 0, bd: 0, in: 0, np: 0, id: 0, bd: 0, vn: 0, tr: 0, bd: 0, pk: 0, bd: 0, dz: 0, do: 0, bd: 0, in: 0, in: 0, sg: 0, bd: 0, br: 0, bd: 0, vn: 0, ph: 0, bd: 0, in: 0, vn: 0, mk: 0, bd: 0, bd: 0, in: 0, dz: 0, in: 0, bh: 0, bd: 0, in: 0, in: 0, tr: 0, bd: 0, vn: 0, bd: 0, tr: 0, ng: 0, vn: 0, ng: 0, eg: 0, bd: 0, iq: 0, bd: 0, bd: 0, es: 0, co: 0, dz: 0, co: 0, bd: 0, pk: 0, gb: 0, be: 0, nl: 0, id: 0, eg: 0, id: 0, bd: 0, in: 0, eg: 0, ke: 0, ke: 0, in: 0, eg: 0, pk: 0, eg: 0, pk: 0, do: 0, in: 0, bd: 0, bd: 0, ng: 0, hn: 0, pk: 0, bd: 0, bd: 0, in: 0, eg: 0, bd: 0, in: 0, eg: 0, sg: 0, in: 0, sg: 0, in: 0, it: 0, eg: 0, pk: 0, in: 0, bd: 0, bd: 0, bh: 0, pk: 0, it: 0, eg: 0, bd: 0, bd: 0, in: 0, in: 0, in: 0, in: 0, in: 0, pk: 0, bd: 0, in: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, in: 0, bd: 0, bd: 0, bd: 0, pk: 0, bd: 0, eg: 0, co: 0, ma: 0, tr: 0, ng: 0, eg: 0, in: 0, eg: 0, bd: 0, bd: 0, in: 0, bd: 0, id: 0, nz: 0, bd: 0, bd: 0, bd: 0, bd: 0, ci: 0, md: 0, gb: 0, bd: 0, sa: 0, do: 0, bd: 0, bd: 0, bd: 0, bd: 0, tr: 0, in: 0, bd: 0, ma: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, sa: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, ng: 0, bd: 0, bd: 0, in: 0, bd: 0, in: 0, tr: 0, in: 0, bd: 0, bd: 0, bd: 0, gb: 0, bd: 0, in: 0, bh: 0, sa: 0, bd: 0, bd: 0, in: 0, bd: 0, id: 0, bd: 0, it: 0, bd: 0, bd: 0, in: 0, bd: 0, bd: 0, in: 0, ci: 0, bd: 0, sa: 0, bh: 0, bh: 0, bd: 0, bd: 0, bd: 0, ng: 0, in: 0, sg: 0, pk: 0, pk: 0, bd: 0, eg: 0, ke: 0, bd: 0, bd: 0, pk: 0, pk: 0, bd: 0, id: 0, bd: 0, bd: 0, ci: 0, sa: 0, in: 0, ng: 0, bd: 0, bd: 0, gb: 0, sa: 0, ke: 0, bd: 0, bd: 0, bd: 0, bd: 0, in: 0, in: 0, tj: 0, bd: 0, bd: 0, ug: 0, bd: 0, eg: 0, bd: 0, bd: 0, es: 0, eg: 0, bd: 0, ug: 0, bd: 0, tr: 0, in: 0, bd: 0, bd: 0, in: 0, bd: 0, id: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, jo: 0, eg: 0, in: 0, pk: 0, bd: 0, bd: 0, bd: 0, in: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, in: 0, in: 0, ng: 0, sg: 0, bd: 0, md: 0, bd: 0, bd: 0, in: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, in: 0, bd: 0, in: 0, bd: 0, bd: 0, bd: 0, bh: 0, bd: 0, bd: 0, ci: 0, eg: 0, bd: 0, bd: 0, bd: 0, bd: 0, us: 0, bd: 0, bd: 0, bd: 0, bd: 0, in: 0, in: 0, ng: 0, bd: 0, in: 0, sa: 0, ca: 0, bd: 0, in: 0, in: 0, sa: 0, nz: 0, do: 0, es: 0, bd: 0, bd: 0, in: 0, bd: 0, bd: 0, bd: 0, id: 0, pk: 0, bd: 0, in: 0, in: 0, in: 0, ma: 0, ug: 0, ma: 0, bd: 0, in: 0, in: 0, in: 0, ng: 0, bd: 0, bd: 0, uz: 0, bd: 0, bd: 0, in: 0, sa: 0, bd: 0, bd: 0, bd: 0, ng: 0, sg: 0, in: 0, ng: 0, bd: 0, in: 0, dz: 0, bd: 0, pk: 0, bd: 0, in: 0, in: 0, bd: 0, dz: 0, dz: 0, bh: 0, in: 0, in: 0, bd: 0, fr: 0, bd: 0, ng: 0, bd: 0, lk: 0, dz: 0, fr: 0, pk: 0, bd: 0, bd: 0, in: 0, bd: 0, dz: 0, bd: 0, ng: 0, bd: 0, bd: 0, bd: 0, in: 0, sg: 0, bd: 0, in: 0, id: 0, bd: 0, sg: 0, bd: 0, bd: 0, dz: 0, ng: 0, in: 0, in: 0, do: 0, in: 0, us: 0, in: 0, in: 0, bd: 0, bd: 0, bd: 0, in: 0, cn: 0, dz: 0, in: 0, bd: 0, in: 0, np: 0, in: 0, in: 0, bd: 0, bd: 0, fr: 0, in: 0, ma: 0, in: 0, dz: 0, bd: 0, md: 0, gb: 0, eg: 0, bd: 0, gh: 0, bd: 0, bd: 0, cm: 0, bd: 0, bd: 0, co: 0, sg: 0, bf: 0, ma: 0, bd: 0, bd: 0, ng: 0, md: 0, bd: 0, bd: 0, bd: 0, bd: 0, in: 0, do: 0, ma: 0, in: 0, cm: 0, dz: 0, bf: 0, bd: 0, gb: 0, ng: 0, tr: 0, bd: 0, bd: 0, ng: 0, in: 0, in: 0, np: 0, th: 0, ng: 0, id: 0, dz: 0, in: 0, in: 0, ng: 0, bd: 0, bd: 0, in: 0, in: 0, bd: 0, ng: 0, in: 0, bd: 0, bd: 0, bd: 0, md: 0, pk: 0, bd: 0, bd: 0, bd: 0, bd: 0, dz: 0, id: 0, lt: 0, bd: 0, sa: 0, pk: 0, bd: 0, bd: 0, in: 0, es: 0, sg: 0, bd: 0, in: 0, in: 0, bd: 0, bd: 0, in: 0, bd: 0, bd: 0, in: 0, id: 0, ng: 0, gb: 0, hk: 0, in: 0, ma: 0, in: 0, bd: 0, in: 0, pk: 0, in: 0, eg: 0, in: 0, bd: 0, bd: 0, bd: 0, in: 0, in: 0, tr: 0, in: 0, pk: 0, bh: 0, bd: 0, bd: 0, in: 0, in: 0, in: 0, bd: 0, ae: 0, bd: 0, in: 0, in: 0, in: 0, id: 0, in: 0, in: 0, ng: 0, in: 0, eg: 0, eg: 0, in: 0, sa: 0, in: 0, id: 0, do: 0, bd: 0, in: 0, in: 0, ma: 0, ng: 0, bd: 0, in: 0, in: 0, ng: 0, in: 0, eg: 0, in: 0, in: 0, in: 0, id: 0, bd: 0, in: 0, bd: 0, pk: 0, bd: 0, nl: 0, in: 0, in: 0, sg: 0, bd: 0, bd: 0, in: 0, pk: 0, bd: 0, in: 0, ng: 0, bd: 0, bd: 0, nl: 0, sa: 0, bd: 0, bd: 0, in: 0, id: 0, de: 0, ng: 0, in: 0, de: 0, bd: 0, ng: 0, bd: 0, nz: 0, us: 0, ng: 0, bd: 0, ug: 0, in: 0, id: 0, bd: 0, sg: 0, nl: 0, in: 0, in: 0, id: 0, in: 0, id: 0, id: 0, eg: 0, in: 0, in: 0, sa: 0, us: 0, bd: 0, bf: 0, bd: 0, bd: 0, de: 0, sa: 0, nl: 0, ug: 0, nl: 0, in: 0, in: 0, sa: 0, bd: 0, de: 0, bd: 0, bd: 0, ke: 0, id: 0, bd: 0, ng: 0, de: 0, sa: 0, bf: 0, eg: 0, bf: 0, bd: 0, in: 0, bd: 0, ma: 0, eg: 0, sg: 0, sg: 0, kh: 0, bf: 0, ph: 0, in: 0, in: 0, in: 0, bd: 0, do: 0, sa: 0, ma: 0, ma: 0, ma: 0, ng: 0, bd: 0, hk: 0, bd: 0, de: 0, ng: 0, eg: 0, bd: 0, in: 0, in: 0, id: 0, in: 0, in: 0, id: 0, sa: 0, es: 0, dz: 0, pk: 0, bd: 0, kh: 0, eg: 0, eg: 0, bf: 0, in: 0, in: 0, dz: 0, tr: 0, ng: 0, iq: 0, in: 0, in: 0, kh: 0, kh: 0, in: 0, bf: 0, ma: 0, tr: 0, in: 0, us: 0, pe: 0, ma: 0, iq: 0, id: 0, np: 0, kh: 0, bf: 0, sg: 0, in: 0, my: 0, sg: 0, mm: 0, in: 0, my: 0, ma: 0, bf: 0, kh: 0, id: 0, sg: 0, bd: 0, tr: 0, in: 0, pk: 0, pk: 0, bf: 0, tr: 0, br: 0, my: 0, sg: 0, iq: 0, eg: 0, bf: 0, id: 0, bd: 0, eg: 0, cd: 0, bj: 0, eg: 0, tr: 0, us: 0, eg: 0, bj: 0, tr: 0, gr: 0, bf: 0, ng: 0, in: 0, ng: 0, br: 0, in: 0, in: 0, gb: 0, my: 0, ma: 0, bf: 0, eg: 0, bh: 0, iq: 0, in: 0, vn: 0, bj: 0, bd: 0, in: 0, id: 0, eg: 0, in: 0, bf: 0, eg: 0, my: 0, vn: 0, in: 0, eg: 0, my: 0, in: 0, bd: 0, in: 0, de: 0, bd: 0, eg: 0, gb: 0, id: 0, bf: 0, eg: 0, in: 0, eg: 0, sg: 0, bd: 0, sg: 0, in: 0, in: 0, bj: 0, id: 0, in: 0, bd: 0, in: 0, pk: 0, za: 0, za: 0, ng: 0, in: 0, in: 0, bj: 0, in: 0, bd: 0, za: 0, in: 0, in: 0, bd: 0, in: 0, et: 0, in: 0, ma: 0, in: 0, ug: 0, in: 0, sg: 0, in: 0, in: 0, tr: 0, bd: 0, br: 0, in: 0, bj: 0, do: 0, do: 0, in: 0, eg: 0, et: 0, jp: 0, bd: 0, bd: 0, za: 0, in: 0, eg: 0, in: 0, jp: 0, in: 0, us: 0, pk: 0, in: 0, pk: 0, in: 0, et: 0, iq: 0, in: 0, in: 0, bd: 0, cm: 0, do: 0, do: 0, bd: 0, us: 0, in: 0, in: 0, cm: 0, in: 0, ng: 0, id: 0, in: 0, in: 0, do: 0, gb: 0, in: 0, id: 0, za: 0, et: 0, ve: 0, in: 0, id: 0, in: 0, do: 0, es: 0, ma: 0, do: 0, tr: 0, ae: 0, et: 0, in: 0, sg: 0, ma: 0, co: 0, in: 0, in: 0, us: 0, ng: 0, in: 0, in: 0, sa: 0, in: 0, id: 0, ng: 0, in: 0, in: 0, in: 0, ma: 0, in: 0, in: 0, pk: 0, do: 0, ma: 0, in: 0, in: 0, gb: 0, hk: 0, in: 0, in: 0, in: 0, bj: 0, lk: 0, in: 0, in: 0, in: 0, dz: 0, ir: 0, ir: 0, in: 0, in: 0, pk: 0, bj: 0, in: 0, bj: 0, in: 0, bj: 0, bd: 0, in: 0, in: 0, in: 0, in: 0, id: 0, bd: 0, de: 0, pk: 0, in: 0, bd: 0, in: 0, sg: 0, pk: 0, in: 0, in: 0, id: 0, in: 0, in: 0, ir: 0, in: 0, id: 0, in: 0, in: 0, id: 0, gh: 0, in: 0, in: 0, in: 0, in: 0, in: 0, br: 0, so: 0, za: 0, in: 0, eg: 0, id: 0, in: 0, bd: 0, in: 0, sg: 0, br: 0, in: 0, ke: 0, th: 0, us: 0, in: 0, ke: 0, sg: 0, in: 0, br: 0, us: 0, tr: 0, ke: 0, gb: 0, in: 0, ng: 0, in: 0, gb: 0, ke: 0, in: 0, tr: 0, in: 0, th: 0, in: 0, pk: 0, jp: 0, in: 0, kh: 0, in: 0, in: 0, gb: 0, ke: 0, id: 0, bd: 0, bd: 0, et: 0, in: 0, br: 0, in: 0, in: 0, th: 0, bd: 0, id: 0, ke: 0, gb: 0, in: 0, in: 0, in: 0, us: 0, tj: 0, gb: 0, bj: 0, in: 0, bd: 0, in: 0, jp: 0, ke: 0, ke: 0, pk: 0, in: 0, ro: 0, in: 0, in: 0, jp: 0, de: 0, jp: 0, pk: 0, in: 0, dz: 0, bd: 0, us: 0, tr: 0, in: 0, de: 0, in: 0, de: 0, br: 0, in: 0, in: 0, br: 0, us: 0, id: 0, jp: 0, in: 0, br: 0, in: 0, in: 0, id: 0, us: 0, de: 0, pk: 0, de: 0, us: 0, in: 0, br: 0, in: 0, jp: 0, in: 0, in: 0, ng: 0, in: 0, bd: 0, br: 0, in: 0, bd: 0, id: 0, gb: 0, pk: 0, in: 0, in: 0, in: 0, bd: 0, br: 0, in: 0, in: 0, in: 0, id: 0, in: 0, bd: 0, tz: 0, in: 0, in: 0, gb: 0, id: 0, bd: 0, de: 0, in: 0, de: 0, bd: 0, in: 0, gb: 0, in: 0, in: 0, in: 0, ro: 0, gb: 0, in: 0, in: 0, in: 0, in: 0, eg: 0, in: 0, in: 0, dz: 0, za: 0, in: 0, bd: 0, in: 0, in: 0, co: 0, eg: 0, bd: 0, in: 0, in: 0, in: 0, in: 0, in: 0, id: 0, in: 0, in: 0, tr: 0, in: 0, in: 0, tr: 0, tr: 0, bd: 0, in: 0, in: 0, in: 0, in: 0, in: 0, in: 0, in: 0, us: 0, in: 0, pk: 0, in: 0, bj: 0, bd: 0, in: 0, in: 0, in: 0, pk: 0, in: 0, bd: 0, in: 0, us: 0, ph: 0, bd: 0, ph: 0, ke: 0, in: 0, bd: 0, br: 0, in: 0, za: 0, ng: 0, ir: 0, bj: 0, bd: 0, id: 0, ph: 0, ng: 0, in: 0, in: 0, in: 0, in: 0, in: 0, bj: 0, bj: 0, bd: 0, pk: 0, bj: 0, bd: 0, bd: 0, in: 0, id: 0, bd: 0, in: 0, in: 0, bd: 0, bd: 0, in: 0, in: 0, in: 0, ke: 0, in: 0, bd: 0, in: 0, br: 0, bj: 0, in: 0, bd: 0, vn: 0, in: 0, bj: 0, in: 0, vn: 0, vn: 0, ke: 0, in: 0, et: 0, in: 0, ng: 0, in: 0, in: 0, in: 0, in: 0, et: 0, in: 0, in: 0, in: 0, in: 0, in: 0, in: 0, in: 0, id: 0, in: 0, in: 0, et: 0, et: 0, in: 0, in: 0, in: 0, ke: 0, in: 0, et: 0, ma: 0, et: 0, in: 0, in: 0, my: 0, eg: 0, in: 0, my: 0, in: 0, in: 0, in: 0, in: 0, in: 0, ng: 0, bd: 0, bd: 0, in: 0, bd: 0, dz: 0, th: 0, et: 0, id: 0, in: 0, in: 0, ph: 0, in: 0, br: 0, us: 0, us: 0, in: 0, bd: 0, pk: 0, th: 0, pk: 0, br: 0, pk: 0, in: 0, in: 0, us: 0, bd: 0, dz: 0, tr: 0, br: 0, za: 0, za: 0, in: 0, in: 0, in: 0, in: 0, vn: 0, bd: 0, hk: 0, in: 0, hk: 0, in: 0, dz: 0, us: 0, br: 0, ng: 0, ng: 0, id: 0, in: 0, ma: 0, in: 0, us: 0, in: 0, in: 0, ug: 0, bd: 0, pk: 0, ma: 0, br: 0, pk: 0, id: 0, bd: 0, in: 0, th: 0, ma: 0, in: 0, pa: 0, bd: 0, id: 0, us: 0, ng: 0, in: 0, pe: 0, ng: 0, ma: 0, br: 0, ng: 0, us: 0, ng: 0, in: 0, in: 0, in: 0, in: 0, in: 0, in: 0, us: 0, ke: 0, in: 0, id: 0, pk: 0, in: 0, in: 0, in: 0, br: 0, in: 0, us: 0, pk: 0, in: 0, in: 0, bd: 0, gh: 0, in: 0, in: 0, us: 0, hk: 0, ng: 0, ng: 0, in: 0, pk: 0, az: 0, id: 0, in: 0, bd: 0, pk: 0, in: 0, th: 0, in: 0, ng: 0, ke: 0, gh: 0, gh: 0, pk: 0, in: 0, br: 0, br: 0, in: 0, in: 0, bd: 0, ge: 0, es: 0, pl: 0, ng: 0, pl: 0, in: 0, in: 0, es: 0, in: 0, in: 0, ph: 0, pk: 0, ph: 0, in: 0, in: 0, de: 0, ng: 0, bd: 0, us: 0, ro: 0, in: 0, ph: 0, np: 0, in: 0, us: 0, br: 0, ph: 0, in: 0, in: 0, in: 0, in: 0, ph: 0, np: 0, in: 0, br: 0, in: 0, in: 0, us: 0, ph: 0, my: 0, us: 0, br: 0, id: 0, cd: 0, in: 0, in: 0, bd: 0, eg: 0, ng: 0, us: 0, in: 0, ng: 0, in: 0, in: 0, in: 0, in: 0, bd: 0, in: 0, cd: 0, ng: 0, in: 0, in: 0, br: 0, in: 0, ng: 0, in: 0, ng: 0, eg: 0, bd: 0, in: 0, pk: 0, gh: 0, my: 0, ph: 0, pk: 0, in: 0, ke: 0, my: 0, in: 0, br: 0, ng: 0, in: 0, in: 0, ec: 0, eg: 0, ng: 0, in: 0, ng: 0, ng: 0, in: 0, in: 0, in: 0, in: 0, us: 0, in: 0, id: 0, br: 0, ng: 0, ng: 0, cm: 0, cm: 0, ng: 0, sg: 0, in: 0, ng: 0, in: 0, ng: 0, ae: 0, cm: 0, eg: 0, in: 0, id: 0, id: 0, bd: 0, in: 0, in: 0, ke: 0, in: 0, id: 0, nl: 0, dz: 0, dz: 0, nl: 0, bd: 0, in: 0, in: 0, jo: 0, ng: 0, bd: 0, in: 0, nl: 0, us: 0, dz: 0, bd: 0, pk: 0, bd: 0, ng: 0, in: 0, tr: 0, bd: 0, in: 0, et: 0, jo: 0, bd: 0, jo: 0, et: 0, eg: 0, us: 0, ae: 0, tn: 0, ng: 0, in: 0, br: 0, bd: 0, ma: 0, et: 0, in: 0, jo: 0, dz: 0, br: 0, ng: 0, in: 0, et: 0, in: 0, jo: 0, dz: 0, bd: 0, ae: 0, in: 0, ae: 0, ng: 0, bd: 0, ng: 0, ng: 0, id: 0, cd: 0, in: 0, pk: 0, jo: 0, de: 0, pk: 0, de: 0, et: 0, do: 0, in: 0, in: 0, bd: 0, in: 0, in: 0, bd: 0, in: 0, ng: 0, et: 0, et: 0, ae: 0, pk: 0, tr: 0, bd: 0, do: 0, bd: 0, in: 0, br: 0, in: 0, ma: 0, in: 0, tr: 0, dz: 0, bd: 0, pk: 0, ng: 0, bd: 0, pk: 0, sa: 0, in: 0, in: 0, pk: 0, bd: 0, et: 0, bd: 0, bd: 0, jo: 0, in: 0, jo: 0, bd: 0, ng: 0, fr: 0, bd: 0, bd: 0, in: 0, in: 0, bd: 0, tr: 0, bd: 0, id: 0, id: 0, et: 0, ng: 0, eg: 0, bd: 0, pk: 0, bd: 0, ng: 0, in: 0, pk: 0, bd: 0, id: 0, et: 0, bd: 0, bd: 0, ng: 0, eg: 0, in: 0, bd: 0, nl: 0, bd: 0, in: 0, in: 0, ng: 0, in: 0, bd: 0, in: 0, in: 0, pk: 0, in: 0, ng: 0, np: 0, in: 0, ng: 0, de: 0, in: 0, np: 0, ng: 0, in: 0, bd: 0, bd: 0, bd: 0, in: 0, np: 0, us: 0, ma: 0, id: 0, tn: 0, ch: 0, in: 0, np: 0, br: 0, in: 0, in: 0, tr: 0, et: 0, ae: 0, np: 0, bd: 0, pk: 0, et: 0, pk: 0, np: 0, in: 0, bd: 0, pk: 0, in: 0, in: 0, in: 0, pk: 0, bd: 0, in: 0, in: 0, ng: 0, bd: 0, in: 0, jo: 0, in: 0, in: 0, in: 0, in: 0, id: 0, bd: 0, np: 0, bd: 0, bd: 0, za: 0, bd: 0, bd: 0, us: 0, us: 0, np: 0, bd: 0, bd: 0, us: 0, ng: 0, tr: 0, pk: 0, bd: 0, in: 0, pt: 0, in: 0, in: 0, bd: 0, in: 0, us: 0, in: 0, tr: 0, bd: 0, us: 0, us: 0, in: 0, in: 0, bd: 0, tr: 0, us: 0, bd: 0, us: 0, us: 0, gb: 0, lk: 0, ci: 0, lk: 0, pk: 0, us: 0, tr: 0, ng: 0, in: 0, us: 0, in: 0, ng: 0, bd: 0, pt: 0, ng: 0, us: 0, in: 0, ng: 0, cd: 0, ng: 0, tr: 0, ae: 0, in: 0, bd: 0, bd: 0, bd: 0, dz: 0, ng: 0, bd: 0, bd: 0, bd: 0, bd: 0, in: 0, bd: 0, in: 0, do: 0, tr: 0, ng: 0, bd: 0, bd: 0, eg: 0, bd: 0, us: 0, bd: 0, ng: 0, bd: 0, bd: 0, bd: 0, eg: 0, bd: 0, ng: 0, bd: 0, bd: 0, ng: 0, bd: 0, in: 0, us: 0, tn: 0, ae: 0, eg: 0, in: 0, tr: 0, bd: 0, eg: 0, in: 0, in: 0, bd: 0, bd: 0, sg: 0, ng: 0, ma: 0, id: 0, bd: 0, in: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, bd: 0, in: 0, bd: 0, bd: 0, bd: 0, bd: 0, ng: 0, gb: 0, gb: 0, bd: 0, in: 0, id: 0, bd: 0, ng: 0, bd: 0, tn: 0, br: 0, in: 0, bd: 0, bd: 0, in: 0, in: 0, in: 0, in: 0, in: 0, in: 0, in: 0, bd: 0, bd: 0, bd: 0, in: 0, in: 0, eg: 0, pk: 0, ng: 0, bd: 0, in: 0, bd: 0, ng: 0, in: 0, bd: 0, in: 0, br: 0, eg: 0, in: 0, in: 0, jo: 0, in: 0, gh: 0, bd: 0, in: 0, in: 0, bd: 0, de: 0, in: 0, eg: 0, bd: 0, in: 0, bd: 0, bd: 0, pt: 0, ng: 0, in: 0, in: 0, ma: 0, in: 0, bd: 0, in: 0, in: 0, hk: 0, bd: 0, kr: 0, co: 0, bd: 0, gh: 0, in: 0, in: 0, ng: 0, in: 0, ng: 0, in: 0, br: 0, bd: 0, ma: 0, nz: 0, in: 0, tn: 0, ph: 0, in: 0, bd: 0, tn: 0, vn: 0, in: 0, id: 0, pk: 0, in: 0, in: 0, bd: 0, in: 0, vn: 0, in: 0, bd: 0, bd: 0, id: 0, in: 0, it: 0, bd: 0, ng: 0, in: 0, bd: 0, ng: 0, in: 0, in: 0, in: 0, bd: 0, eg: 0, ng: 0, ng: 0, in: 0, bd: 0, id: 0, in: 0, in: 0, in: 0, kr: 0, in: 0, ma: 0, bd: 0, bd: 0, ng: 0, et: 0, bd: 0, ng: 0, in: 0, in: 0, pk: 0, in: 0, ma: 0, bd: 0, bd: 0, in: 0, eg: 0, ma: 0, sg: 0, in: 0, et: 0, et: 0, bd: 0, in: 0, it: 0, de: 0, in: 0, ng: 0, tr: 0, et: 0, de: 0, eg: 0, eg: 0, vn: 0, eg: 0, de: 0, bd: 0, ng: 0, et: 0, bd: 0, et: 0, de: 0, in: 0, bd: 0, de: 0, eg: 0, pk: 0, ma: 0, lr: 0, fr: 0, kh: 0, pk: 0, ma: 0, tr: 0, eg: 0, iq: 0, de: 0, tr: 0, in: 0, tr: 0, pk: 0, bd: 0, eg: 0, pk: 0, de: 0, it: 0, in: 0, bd: 0, et: 0, bd: 0, sg: 0, bd: 0, in: 0, bd: 0, ke: 0, bd: 0, de: 0, bd: 0, np: 0, ma: 0, np: 0, bd: 0, in: 0, br: 0, ph: 0, in: 0, in: 0, in: 0, vn: 0, bd: 0, in: 0, in: 0, de: 0, bd: 0, in: 0, et: 0, et: 0, dz: 0, in: 0, pk: 0, id: 0, pk: 0, tr: 0, in: 0, in: 0, in: 0, de: 0, eg: 0, in: 0, bj: 0, eg: 0, in: 0, dz: 0, bd: 0, in: 0, eg: 0, bd: 0, in: 0, np: 0, bd: 0, dz: 0, eg: 0, bj: 0, np: 0, eg: 0, kh: 0, bj: 0, in: 0, tn: 0, dz: 0, in: 0, in: 0, in: 0, tr: 0, eg: 0, id: 0, eg: 0, id: 0, bd: 0, in: 0, ma: 0, tr: 0, bd: 0, in: 0, tn: 0, tr: 0, in: 0, in: 0, in: 0, in: 0, tr: 0, jo: 0, fr: 0, de: 0, pk: 0, in: 0, id: 0, id: 0, in: 0, ng: 0, ma: 0, bd: 0, in: 0, jo: 0, np: 0, bd: 0, np: 0, in: 0, rs: 0, ng: 0, tn: 0, de: 0, jo: 0, dz: 0, tn: 0, in: 0, de: 0, ng: 0, vn: 0, pk: 0, ma: 0, dz: 0, mx: 0, de: 0, ph: 0, jo: 0, in: 0, bd: 0, my: 0, ca: 0, dz: 0, eg: 0, dz: 0, pk: 0, pk: 0, ng: 0, ma: 0, in: 0, in: 0, in: 0, in: 0, pl: 0, dz: 0, dz: 0, kh: 0, jo: 0, bd: 0, in: 0, in: 0, bd: 0, np: 0, hk: 0, de: 0, ng: 0, np: 0, in: 0, in: 0, in: 0, et: 0, np: 0, et: 0, np: 0, np: 0, in: 0, pk: 0, np: 0, bd: 0, in: 0, et: 0, et: 0, in: 0, us: 0, in: 0, et: 0, dz: 0, in: 0, in: 0, in: 0, in: 0, in: 0, pk: 0, de: 0, br: 0, in: 0, pk: 0, ng: 0, dz: 0, de: 0, ht: 0, ma: 0, dz: 0, ng: 0, bd: 0, de: 0, ht: 0, in: 0, sg: 0, eg: 0, de: 0, de: 0, bd: 0, eg: 0, ma: 0, dz: 0, in: 0, us: 0, ng: 0, in: 0, de: 0, ph: 0, in: 0, in: 0, dz: 0, in: 0, in: 0, ug: 0, in: 0, ma: 0, in: 0, la: 0, in: 0, tn: 0, eg: 0, in: 0, ph: 0, dz: 0, in: 0, ph: 0, br: 0, ma: 0, ng: 0, in: 0, tr: 0, de: 0, ph: 0, bd: 0, bj: 0, tn: 0, do: 0, eg: 0, bd: 0, gb: 0, ng: 0, ph: 0, in: 0, ma: 0, in: 0, in: 0, us: 0, bd: 0, bd: 0, ma: 0, de: 0, in: 0, in: 0, ae: 0, ae: 0, in: 0, pk: 0, ng: 0, in: 0, in: 0, in: 0, dz: 0, ng: 0, bd: 0, ng: 0, in: 0, ae: 0, in: 0, bd: 0, in: 0, ng: 0, vn: 0, in: 0, ng: 0, vn: 0, ng: 0, vn: 0, vn: 0, bj: 0, dz: 0, in: 0, vn: 0, in: 0, in: 0, dz: 0, in: 0, es: 0, bd: 0, ae: 0, ng: 0, in: 0, vn: 0, tr: 0, vn: 0, ae: 0, vn: 0, vn: 0, in: 0, ng: 0, bd: 0, vn: 0, bd: 0, de: 0, in: 0, hk: 0, in: 0, mo: 0, hk: 0, hk: 0, gb: 0, es: 0, us: 0, eg: 0, cn: 0, ph: 0, bd: 0, id: 0, ng: 0, cm: 0, al: 0, eg: 0, in: 0, al: 0, bd: 0, ma: 0, ma: 0, in: 0, bd: 0, eg: 0, in: 0, hk: 0, in: 0, ma: 0, in: 0, tr: 0, bd: 0, tr: 0, tr: 0, iq: 0, al: 0, in: 0, bd: 0, us: 0, hk: 0, bd: 0, vn: 0, tr: 0, vn: 0, tz: 0, us: 0, ng: 0, bd: 0, vn: 0, ng: 0, vn: 0, nl: 0, ug: 0,: 0, ng: 0, hk: 0, dz: 0, id: 0, ng: 0, hk: 0, it: 0, ke: 0, ke: 0, in: 0, pk: 0, id: 0, us: 0, bd: 0, ke: 0, tz: 0, ng: 0, eg: 0, in: 0, hk: 0, ke: 0, eg: 0, ke: 0, ke: 0, ma: 0, ke: 0, ng: 0, bd: 0, ke: 0, in: 0, hk: 0, bd: 0, in: 0, np: 0, in: 0, bd: 0, eg: 0, bd: 0, sa: 0, bd: 0, bd: 0, in: 0, bd: 0, lb: 0, in: 0, ke: 0, in: 0, in: 0, bd: 0, bd: 0, in: 0, et: 0, bd: 0, id: 0, ng: 0, bd: 0, bd: 0, in: 0, bd: 0, pk: 0, pk: 0, et: 0, bd: 0, de: 0, bd: 0, in: 0, in: 0, in: 0, in: 0, bd: 0, bd: 0, in: 0, ph: 0, bd: 0, in: 0, id: 0, rw: 0, bd: 0, gb: 0, in: 0, ng: 0, bd: 0, ng: 0, ph: 0, bd: 0, ng: 0, gb: 0, in: 0, bd: 0, in: 0, ma: 0, in: 0, jp: 0, hk: 0, tr: 0, eg: 0, in: 0, in: 0, tr: 0, eg: 0, ph: 0, ma: 0, in: 0, in: 0, ma: 0, id: 0, ng: 0, ke: 0, bd: 0, bd: 0, bd: 0, et: 0, id: 0, eg: 0, ye: 0, bd: 0, eg: 0, ss: 0, in: 0, in: 0, ma: 0, hk: 0, ke: 0, in: 0, in: 0, hk: 0, in: 0, bj: 0, ye: 0, bd: 0, br: 0, br: 0, ng: 0, bj: 0, eg: 0, gh: 0, in: 0, in: 0, in: 0, br: 0, gb: 0, pk: 0, pk: 0

                }),
                onLabelShow: function (event, label, code) {
                    if (chart_data[code] > 0) {
                        label.append(': <strong>' + chart_data[code] + '</strong>');
                    }
                }
                /* onRegionClick: function (element, code) {
                 }*/
            });

            var user = { "1": { "count": 51, "month": "Jan" }, "2": { "count": 42, "month": "Feb" }, "3": { "count": 40, "month": "Mar" }, "4": { "count": 39, "month": "Apr" }, "5": { "count": 0, "month": "May" }, "6": { "count": 0, "month": "Jun" }, "7": { "count": 0, "month": "Jul" }, "8": { "count": 0, "month": "Aug" }, "9": { "count": 0, "month": "Sep" }, "10": { "count": 0, "month": "Oct" }, "11": { "count": 0, "month": "Nov" }, "12": { "count": 0, "month": "Dec" } };
            var total = 5815;
            users_Analysis(total, user[1]['count'], user[2]['count'], user[3]['count'], user[4]['count'], user[5]['count'], user[6]['count'], user[7]['count'], user[8]['count'], user[9]['count'], user[10]['count'], user[11]['count'], user[12]['count']);

            ads_Analysis("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
        });
    </script>

    <script>
        if (document.getElementById('category-list')) {
            const dataTableSearch = new simpleDatatables.DataTable("#category-list", {
                searchable: true,
                fixedHeight: true,
                perPage: 15,
                labels: {
                    placeholder: "Search...",
                    perPage: "Show {select} entries",
                    noRows: "No entries found",
                    info: "Showing 1 to 15 of 460 entries"
                },
            });

            document.querySelectorAll(".export").forEach(function (el) {
                el.addEventListener("click", function (e) {
                    var type = el.dataset.type;

                    var data = {
                        type: type,
                        filename: "alias-" + type,
                    };

                    if (type === "csv") {
                        data.columnDelimiter = "|";
                    }

                    dataTableSearch.export(data);
                });
            });
        };
    </script>

    <script>
        if (document.getElementById('data-list')) {
            const dataTableSearch = new simpleDatatables.DataTable("#data-list", {
                searchable: true,
                fixedHeight: true,
                perPage: 15,
                labels: {
                    placeholder: "Search...",
                    perPage: "Show {select} entries",
                    noRows: "No entries found",
                    info: "Showing 1 to 6 of 6 entries"
                },
            });

            document.querySelectorAll(".export").forEach(function (el) {
                el.addEventListener("click", function (e) {
                    var type = el.dataset.type;

                    var data = {
                        type: type,
                        filename: "alias-" + type,
                    };

                    if (type === "csv") {
                        data.columnDelimiter = "|";
                    }

                    dataTableSearch.export(data);
                });
            });
        };
    </script>
    
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const currentUrl = window.location.href;
            const navLinks = document.querySelectorAll(".nav-link");

            navLinks.forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
            });
        });
   </script>
   
    <script>
        $(document).ready(function () {
            $("#alert-success").delay(3000).slideUp(300);
        });

        $("body").on("click", ".addCat", function () {
            $("#rewardCatModal").modal('show');
        });

        $("body").on("click", ".editCat", function () {
            var current_object = $(this);
            var link = window.location.origin;
            id = current_object.attr('id');
            $.ajax({
                url: 'withdrawal/edit/' + id,
                type: "GET",

                success: function (data) {
                    $("#UpdaterewardCatModal").modal('show');
                    $("#reward_cat_id").val(data[0]['id']);
                    $("#catname").val(data[0]['name']);
                    $("#country").val(data[0]['country']);
                    $("#redeem_cat_min_coin").val(data[0]['min_coin']);
                    $("#reward_cat_oldicon").val(data[0]['image']);
                    CKEDITOR.instances['redeemcat_description'].setData(data[0]['description']);

                    $("#oldicon").val(data[0]['image']);
                    console.log(data[0]['name']);
                },
            });

        });

        $("body").on("click", ".addGame", function () {
            $("#gameModal").modal('show');
        });

        $("body").on("click", ".editGame", function () {
            var current_object = $(this);
            var link = window.location.origin;
            id = current_object.attr('id');
            $.ajax({
                url: 'games/edit/' + id,
                type: "GET",

                success: function (data) {
                    $("#gameupdateModal").modal('show');
                    $("#id").val(data[0]['id']);
                    $("#link").val(data[0]['link']);
                    $("#title").val(data[0]['title']);
                    $("#oldicon").val(data[0]['image']);

                    console.log(data[0]['id']);
                },
            });

        });

        $("body").on("click", ".reject_dailyoffer", function () {
            var current_object = $(this);
            var id = current_object.attr('id');
            console.log('id=>' + id);
            $("#dailyoffermodal").modal('show');
            $("#dofferid").val(id);
        });

        $("body").on("click", ".approvePayment", function () {
            var current_object = $(this);
            var id = current_object.attr('id');
            console.log('id=>' + id);
            $("#withdraw_approve").modal('show');
            $("#request_id").val(id);
        });

        $("body").on("click", ".viewpostback", function () {
            var current_object = $(this);
            var id = current_object.attr('id');
            $('#postbackmodal').modal('show');
            $("#pb").text(id);
        });

        if (document.getElementById('activitylist')) {
            const dataTableSearch = new simpleDatatables.DataTable("#activitylist", {
                searchable: true,
                fixedHeight: true,
                perPage: 15,
                labels: {
                    placeholder: "Search...",
                    perPage: "Show {select} entries",
                    noRows: "No entries found",
                    info: "Showing  to  of 0 entries"
                },
            });

            document.querySelectorAll(".export").forEach(function (el) {
                el.addEventListener("click", function (e) {
                    var type = el.dataset.type;

                    var data = {
                        type: type,
                        filename: "alias-" + type,
                    };

                    if (type === "csv") {
                        data.columnDelimiter = "|";
                    }

                    dataTableSearch.export(data);
                });
            });
        };

        $("body").on("click", ".updateUserStatus", function () {
            var current_object = $(this);
            var id = current_object.attr('id');
            var status = current_object.attr('data-id');
            console.log('status=>' + status + '  userid=?' + id);
            $("#AcStatusModal").modal('show');
            $("#banid").val(id);
            $("#banstatus").val(status);
            if (status == 0) {
                $("#exampleModalLabel").val('Ban Account');
            } else {
                $("#exampleModalLabel").val('Unban Account');
            }

        });

        $("body").on("click", ".updateUserBal", function () {
            var current_object = $(this);
                var id = current_object.attr('id');
                console.log('id=>' + id);
                $("#balanceModal").modal('show');
                $("#uid").val(id);

        });

        $("body").on("click", ".sendnoti", function () {
            var current_object = $(this);
                var id = current_object.attr('id');
                console.log('id=>' + id);
                $("#usernotimodal").modal('show');
                $("#userid").val(id);

        });

        $("body").on("click", ".rejectpromo", function () {
            var current_object = $(this);
                var id = current_object.attr('id');
                var type = current_object.attr('data-id');
                console.log('id=>' + id);
                $("#promorejmodal").modal('show');
                $("#promoid").val(id);
                $("#promotype").val(type);

        });

    </script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.4"></script>

</body>

</html>