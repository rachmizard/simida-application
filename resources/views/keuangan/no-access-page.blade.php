

<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<!-- Mirrored from getbootstrapadmin.com/remark/base/pages/blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Nov 2018 04:19:12 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title>{{ config('app.name', 'SIMIDA') }}</title>

  <link rel="apple-touch-icon" href="/assets/img/logo/apple-touch-icon.png">
  <link rel="shortcut icon" href="/assets/img/logo/favicon.ico">

  <!-- CSRF_TOKEN -->
  <meta id="token" name="csrf-token" content="{{ csrf_token() }}">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="/assets/css/bootstrap.min599c.css">
  <link rel="stylesheet" href="/assets/css/bootstrap-extend.min599c.css">
  <link rel="stylesheet" href="/assets/css/site.min599c.css">

  <!-- Skin tools (demo site only) -->
  <link rel="stylesheet" href="/assets/css/skintools.min599c.css?v4.0.2">
  <script src="/assets/js/plugin/skintools.min599c.js?v4.0.2"></script>

  <!-- Plugins -->
  <link rel="stylesheet" href="/assets/vendor/animsition/animsition.min599c.css?v4.0.2">
  <link rel="stylesheet" href="/assets/vendor/asscrollable/asScrollable.min599c.css?v4.0.2">
  <link rel="stylesheet" href="/assets/vendor/switchery/switchery.min599c.css?v4.0.2">
  <link rel="stylesheet" href="/assets/vendor/intro-js/introjs.min599c.css?v4.0.2">
  <link rel="stylesheet" href="/assets/vendor/slidepanel/slidePanel.min599c.css?v4.0.2">
  <link rel="stylesheet" href="/assets/vendor/flag-icon-css/flag-icon.min599c.css?v4.0.2">


  <!-- Plugins This page-->
  <link rel="stylesheet" href="/assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min599c.css">
  <link rel="stylesheet" href="/assets/vendor/select2/select2.min599c.css?v4.0.2">
    <!-- Datatable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.2/css/autoFill.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.5.0/css/colReorder.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.5/css/fixedColumns.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.4/css/fixedHeader.bootstrap4.min.css">
  <link rel="stylesheet" href="https://getbootstrapadmin.com/remark/global/vendor/webui-popover/webui-popover.min.css?v4.0.2">
  <link rel="stylesheet" href="https://getbootstrapadmin.com/remark/global/vendor/toolbar/toolbar.min.css?v4.0.2">  
  <link rel="stylesheet" href="https://getbootstrapadmin.com/remark/global/vendor/tablesaw/tablesaw.min.css?v4.0.2">

    <!-- FORM WIZARD -->
  <link rel="stylesheet" href="https://getbootstrapadmin.com/remark/global/vendor/jquery-wizard/jquery-wizard.min.css?v4.0.2">
  <link rel="stylesheet" href="https://getbootstrapadmin.com/remark/global/vendor/formvalidation/formValidation.min.css?v4.0.2">

  <!-- Fonts -->
  <link rel="stylesheet" href="/assets/fonts/web-icons/web-icons.min599c.css?v4.0.2">
  <link rel="stylesheet" href="/assets/fonts/brand-icons/brand-icons.min599c.css?v4.0.2">
  <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">
  
  <!-- Scripts -->
  <script src="/assets/vendor/breakpoints/breakpoints.min599c.js?v4.0.2"></script>
  <script>
    Breakpoints();
  </script>

  <!-- CSRF_TOKEN -->
  <script>
      window.Laravel = {!! json_encode([
          'csrfToken' => csrf_token(),
      ]) !!};
  </script>

  <style>
    .dt-buttons{
      right:0%;
    }
  </style>
  
  <!-- Plugins For This Page -->
  <link rel="stylesheet" href="/assets/vendor/bootstrap-table/bootstrap-table.min599c.css?v4.0.2">

  <!-- Custome Vue Transition CSS -->

<!-- CUSTOM SLIDE TRANSITION CSS -->
  <style>
    /* Enter and leave animations can use different */
    /* durations and timing functions.              */
    .slide-fade-enter-active {
      transition: all .3s ease;
    }
    .slide-fade-leave-active {
      transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
      transform: translateX(10px);
      opacity: 0;
    }
  </style>

</head>

<body class="animsition page-error page-error-505 layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


  <!-- Page -->
  <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">
      <header>
        <h1 class="animation-slide-top">{{ $errorType }}</h1>
        <p>{{ $messageTitle }}</p>
      </header>
      <p class="error-advise">{{ $messageCaption }}</p>
      <a class="btn btn-primary btn-round" href="{{ route('keuangan.home') }}">Kembali</a>

      <footer class="page-copyright">
        <p>WEBSITE BY Birutekno Inc.</p>
        <p>© 2018. All RIGHT RESERVED.</p>
      </footer>
    </div>
  </div>
  <!-- End Page -->
</body>
<!-- VUE JS -->
<script src="{{asset('/js/app.js')}}"></script>
<!-- Core  -->
<script src="/assets/vendor/babel-external-helpers/babel-external-helpers599c.js?v4.0.2"></script>
<script src="/assets/vendor/jquery/jquery.min599c.js?v4.0.2"></script>
<script src="/assets/vendor/popper-js/umd/popper.min599c.js?v4.0.2"></script>
<script src="/assets/vendor/bootstrap/bootstrap.min599c.js?v4.0.2"></script>
<script src="/assets/vendor/animsition/animsition.min599c.js?v4.0.2"></script>
<script src="/assets/vendor/mousewheel/jquery.mousewheel599c.js?v4.0.2"></script>
<script src="/assets/vendor/asscrollbar/jquery-asScrollbar.min599c.js?v4.0.2"></script>
<script src="/assets/vendor/asscrollable/jquery-asScrollable.min599c.js?v4.0.2"></script>
<script src="/assets/vendor/ashoverscroll/jquery-asHoverScroll.min599c.js?v4.0.2"></script> 
  <!-- Scripts -->
  <script src="/assets/js/component.min599c.js?v4.0.2"></script>
  <script src="/assets/js/plugin.min599c.js?v4.0.2"></script>
  <script src="/assets/js/base.min599c.js?v4.0.2"></script>
  <script src="/assets/js/config.min599c.js?v4.0.2"></script>

  <script src="/assets/js/section/menubar.min599c.js?v4.0.2"></script>
  <script src="/assets/js/section/gridMenu.min599c.js?v4.0.2"></script>
  <script src="/assets/js/section/sidebar.min599c.js?v4.0.2"></script>
  <script src="/assets/js/section/pageAside.min599c.js?v4.0.2"></script>
  <script src="/assets/js/plugin/menu.min599c.js?v4.0.2"></script>
  <!-- Page -->
  <script src="/assets/js/site.min599c.js?v4.0.2"></script>
  <script src="/assets/js/code-editor.min599c.js"></script>
  <!-- Plugins For This Page -->
  <script src="/assets/vendor/bootstrap-table/bootstrap-table.min599c.js?v4.0.2"></script>
  <script src="/assets/vendor/bootstrap-table/extensions/mobile/bootstrap-table-mobile.min599c.js?v4.0.2"></script>
  <script src="/assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min599c.js"></script>
    <script>
    $('.datelahir').datepicker({
        format: "yyyy-mm-dd",
        clearBtn: true,
        language: "id"
        // defaultViewDate: { year: 2000, month: 01, day: 01 }
        
    });

    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        clearBtn: true,
        language: "id"
        // defaultViewDate: { year: 2000, month: 01, day: 01 }
        
    });

    $('.datepickerMonth').datepicker({
        format: "yyyy-mm",
        clearBtn: true,
        language: "id"
        // defaultViewDate: { year: 2000, month: 01, day: 01 }        
    });

    </script>
    <script src="/assets/vendor/select2/select2.full.min599c.js?v4.0.2"></script>
    <script>
    $(document).ready(function() {
        $('.selectTo').select2();
    });
    </script>

    <script src="https://getbootstrapadmin.com/remark/global/vendor/tablesaw/tablesaw.jquery.js?v4.0.2"></script>
    <script src="https://getbootstrapadmin.com/remark/global/vendor/tablesaw/tablesaw-init.js?v4.0.2"></script>
      <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.3.2/js/dataTables.autoFill.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.3.2/js/autoFill.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/colreorder/1.5.0/js/dataTables.colReorder.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.4/js/dataTables.fixedHeader.min.js"></script>
    <!-- Tooltip -->
    <script src="https://getbootstrapadmin.com/remark/global/vendor/webui-popover/jquery.webui-popover.min.js?v4.0.2"></script>
    <script src="https://getbootstrapadmin.com/remark/global/vendor/toolbar/jquery.toolbar.js?v4.0.2"></script>
      <!-- Form Wizard -->

      <script src="https://getbootstrapadmin.com/remark/global/vendor/formvalidation/formValidation.min.js?v4.0.2"></script>
      <script src="https://getbootstrapadmin.com/remark/global/vendor/formvalidation/framework/bootstrap.min.js?v4.0.2"></script>
      <script src="https://getbootstrapadmin.com/remark/global/vendor/matchheight/jquery.matchHeight-min.js?v4.0.2"></script>
      <script src="https://getbootstrapadmin.com/remark/global/vendor/jquery-wizard/jquery-wizard.min.js?v4.0.2"></script>
      <script src="https://getbootstrapadmin.com/remark/global/js/Plugin/jquery-wizard.min.js?v4.0.2"></script>
      <script src="https://getbootstrapadmin.com/remark/global/js/Plugin/matchheight.min.js?v4.0.2"></script>
      <script src="https://getbootstrapadmin.com/remark/base/assets/examples/js/forms/wizard.min.js?v4.0.2"></script>


    <script src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/1.5.1/js/dataTables.scroller.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

<script>

! function(global, factory) {
    if ("function" == typeof define && define.amd) define("/tables/bootstrap", ["jquery", "Site"], factory);
    else if ("undefined" != typeof exports) factory(require("jquery"), require("Site"));
    else {
        var mod = {
            exports: {}
        };
        factory(global.jQuery, global.Site), global.tablesBootstrap = mod.exports
    }
}(this, function(_jquery, _Site) {
    "use strict";
    var _jquery2 = babelHelpers.interopRequireDefault(_jquery),
        Site = babelHelpers.interopRequireWildcard(_Site);
    (0, _jquery2.default)(document).ready(function($) {
            Site.run()
        }),
        function() {
            var bt_data = [{
                Tid: "1",
                First: "Jill",
                Last: "Smith",
                Score: "50"
            }, {
                Tid: "2",
                First: "Eve",
                Last: "Jackson",
                Score: "94"
            }, {
                Tid: "3",
                First: "John",
                Last: "Doe",
                Score: "80"
            }, {
                Tid: "4",
                First: "Adam",
                Last: "Johnson",
                Score: "67"
            }, {
                Tid: "5",
                First: "Fish",
                Last: "Johnson",
                Score: "100"
            }, {
                Tid: "6",
                First: "CC",
                Last: "Joson",
                Score: "77"
            }, {
                Tid: "7",
                First: "UDIN",
                Last: "Yoson",
                Score: "87"
            }];
            (0, _jquery2.default)("#exampleTableFromData").bootstrapTable({
                data: bt_data,
                height: "250"
            })
        }(), (0, _jquery2.default)("#exampleTableColumns").bootstrapTable({
            url: "../assets/data/bootstrap_table_test.json",
            height: "400",
            iconSize: "outline",
            showColumns: !0,
            icons: {
                refresh: "wb-refresh",
                toggle: "wb-order",
                columns: "wb-list-bulleted"
            }
        }),
        function($el, cells, rows) {
            var i, j, row, columns = [],
                data = [];
            for (i = 0; i < cells; i++) columns.push({
                field: "field" + i,
                title: "Cell" + i
            });
            for (i = 0; i < rows; i++) {
                for (row = {}, j = 0; j < cells; j++) row["field" + j] = "Row-" + i + "-" + j;
                data.push(row)
            }
            $el.bootstrapTable("destroy").bootstrapTable({
                columns: columns,
                data: data,
                iconSize: "outline",
                icons: {
                    columns: "wb-list-bulleted"
                }
            })
        }((0, _jquery2.default)("#exampleTableLargeColumns"), 50, 50), (0, _jquery2.default)("#exampleTableToolbar").bootstrapTable({
            url: "../assets/data/bootstrap_table_test2.json",
            search: !0,
            pagination: true,
            showRefresh: !0,
            showToggle: !0,
            showColumns: !0,
            toolbar: "#exampleToolbar",
            iconSize: "outline",
            icons: {
                refresh: "wb-refresh",
                toggle: "wb-order",
                columns: "wb-list-bulleted"
            }
        }),
        function() {
            (0, _jquery2.default)("#exampleTableEvents").bootstrapTable({
                url: "../assets/data/bootstrap_table_test.json",
                search: !0,
                pagination: !0,
                showRefresh: !0,
                showToggle: !0,
                showColumns: !0,
                iconSize: "outline",
                toolbar: "#exampleTableEventsToolbar",
                icons: {
                    refresh: "wb-refresh",
                    toggle: "wb-order",
                    columns: "wb-list-bulleted"
                }
            });
            var $result = (0, _jquery2.default)("#examplebtTableEventsResult");
            (0, _jquery2.default)("#exampleTableEvents").on("all.bs.table", function(e, name, args) {}).on("click-row.bs.table", function(e, row, $element) {
                $result.text("Event: click-row.bs.table")
            }).on("dbl-click-row.bs.table", function(e, row, $element) {
                $result.text("Event: dbl-click-row.bs.table")
            }).on("sort.bs.table", function(e, name, order) {
                $result.text("Event: sort.bs.table")
            }).on("check.bs.table", function(e, row) {
                $result.text("Event: check.bs.table")
            }).on("uncheck.bs.table", function(e, row) {
                $result.text("Event: uncheck.bs.table")
            }).on("check-all.bs.table", function(e) {
                $result.text("Event: check-all.bs.table")
            }).on("uncheck-all.bs.table", function(e) {
                $result.text("Event: uncheck-all.bs.table")
            }).on("load-success.bs.table", function(e, data) {
                $result.text("Event: load-success.bs.table")
            }).on("load-error.bs.table", function(e, status) {
                $result.text("Event: load-error.bs.table")
            }).on("column-switch.bs.table", function(e, field, checked) {
                $result.text("Event: column-switch.bs.table")
            }).on("page-change.bs.table", function(e, size, number) {
                $result.text("Event: page-change.bs.table")
            }).on("search.bs.table", function(e, text) {
                $result.text("Event: search.bs.table")
            })
        }()
});    
</script>
@stack('otherJavascript')
</html>