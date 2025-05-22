<script type="text/javascript" src="https://reapbucks.com/admin/assets/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="https://reapbucks.com/admin/assets/js/apexcharts.min.js"></script>
<script type="text/javascript" src="https://reapbucks.com/admin/assets/js/jquery.vmap.min.js"></script>
<script type="text/javascript" src="https://reapbucks.com/admin/assets/js/jquery.vmap.world.js"></script>
<script src="https://reapbucks.com/admin/assets/js/bootstrap.bundle.min.js"></script>
<script src="https://reapbucks.com/admin/assets/js/autosize.min.js"></script>
<script type="text/javascript" src="https://reapbucks.com/admin/assets/js/jquery.datetimepicker.full.min.js"></script>

<script src="https://reapbucks.com/admin/assets/js/sweet-alerts.init.js"></script>
<script src="https://reapbucks.com/admin/assets/js/sweetalert2.min.js"></script>
<script src="https://reapbucks.com/admin/assets/js/toaster.init.js"></script>



    <!--ADMIN NOTE Start-->
    <form method="post" action="admin-note-save.php" class="modal modal-blur fade" id="modal-note" tabindex="-1" role="dialog" aria-hidden="true">
        <input type="hidden" name="token_id" value="<?php echo $_SESSION['ADMIN_ID'];?>">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Admin note:</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"></path>
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body pt-1">
                    <textarea name="a_note" class="form-control" data-toggle="autosize" placeholder="Write down your note here..."></textarea>
                    <button type="submit" name="submit" class="btn btn-block btn-dark mt-3">Save and close</button>
                </div>
            </div>
        </div>
    </form>
    <!--ADMIN NOTE End-->
    
    <script>
        function resetTA() {
            setTimeout(function () {
                const elements = document.querySelectorAll('[data-toggle="autosize"]');
                if (elements.length) {
                    elements.forEach(function (element) {
                        autosize(element);
                    });
                }
            }, 200);
        };

    </script>

    <script>
        $(document).on("click", "#discard", function (ev) {
            ev.preventDefault();
            $("#refuse-id").val($(this).data('id'));
            $("#reasoning").val('');
            $("#modal-confirmation").modal({
                backdrop: 'static',
                keyboard: false
            });
        });
    </script>

    <script>
        $(document).on("click", "#sendtype-1-input", function () {
            $('input:radio[id=sendtype-1-radio]').click();
        });
        $(document).on("click", "#sendtype-2-input", function () {
            $('input:radio[id=sendtype-2-radio]').click();
        });
        $(document).on("click", "#sendtype-1-opt", function () {
            var id = $(this).data('id');
            if (id == 1) {
                $("#sendtype-1-text").text('User ID');
                $("#sendtype-1-val").val('1');
            } else {
                $("#sendtype-1-text").text('Email');
                $("#sendtype-1-val").val('2');
            }
        });
        $('.img-input').on('change', function () {
            var fileName = $(this).val().split('\\').pop();
            $(this).closest('.form-file').find('.img-choose').addClass("selected").text(fileName);
        });
    </script>

    <script>
        $('.img-input').on('change', function () {
            var fileName = $(this).val().split('\\').pop();
            $(this).closest('.form-file').find('.img-choose').addClass("selected").text(fileName);
        });
        $(document).on("click", ".btn-close", function (ev) {
            ev.preventDefault();
            $("#cat-id").val($(this).data('id'));
        });
        $(document).on("click", ".btn-edit", function (ev) {
            ev.preventDefault();
            $("#cat-edit-id").val($(this).data('id'));
            $("#cat_name").val($(this).data('title'));
            $("#cat_desc").text($(this).data('desc'));
            $("#cat_reward").val($(this).data('reward'));
            $("#cat_cost").val($(this).data('cost'));
            $("#cat_time").val($(this).data('time'));
        });

    </script>

        <script>
            $('.add-file-input').on('change', function () {
                var fileName = $(this).val().split('\\').pop();
                $(this).closest('.form-file').find('.add-file-choose').addClass("selected").text(fileName);
            });
            $(document).on("click", ".btn-close", function (ev) {
                ev.preventDefault();
                $("#gw-id").val($(this).data('id'));
            });
            $(document).on("click", ".btn-edit", function (ev) {
                ev.preventDefault();
                $("#mod-id").val($(this).data('id'));
                $("#mod-word").val($(this).data('word'));
                $("#mod-info").val($(this).data('infos'));
                $("#mod-country").val($(this).data('country'));
                $("#mod-time").val($(this).data('time'));
            });
        </script>

            <script>
                $(document).on("click", ".btn-close", function (ev) {
                    ev.preventDefault();
                    $("#cat-id").val($(this).data('id'));
                });
                $(document).on("click", ".btn-edit", function (ev) {
                    ev.preventDefault();
                    $("#cat-edit-id").val($(this).data('id'));
                    $("#cat-name").val($(this).data('title'));
                    $("#cat-cost").val($(this).data('cost'));
                    $("#cat-reward").val($(this).data('reward'));
                    $("#cat-time").val($(this).data('time'));
                    $("#cat-row").val($(this).data('row'));
                    $("#cat-col").val($(this).data('col'));
                });
            </script>

            <script>
                $('.img-input').on('change', function () {
                    var fileName = $(this).val().split('\\').pop();
                    $(this).closest('.form-file').find('.img-choose').addClass("selected").text(fileName);
                });
                $(document).on("click", ".btn-close", function (ev) {
                    ev.preventDefault();
                    $("#cat-id").val($(this).data('id'));
                });
                $(document).on("click", ".btn-edit", function (ev) {
                    ev.preventDefault();
                    $("#edit-id").val($(this).data('id'));
                    $("#edit-name").val($(this).data('name'));
                    if ($(this).data('ori') == 1) {
                        $('#edit-orientation').val("1").change();
                    } else {
                        $('#edit-orientation').val("0").change();
                    }
                    if ($(this).data('blocked') == 1) {
                        $("#edit-block").attr('checked', true);
                    } else {
                        $("#edit-block").attr('checked', false);
                    }
                    $("#edit-deduct").val($(this).data('unlock'));
                    var reward = $(this).data('reward');
                    if (reward < 0) {
                        $('#edit-type').val("3").change();
                        $("#edit-reward").val(0 - reward);
                    } else if (reward > 0) {
                        $('#edit-type').val("2").change();
                        $("#edit-reward").val(reward);
                    } else {
                        $('#edit-type').val("1").change();
                        $("#edit-reward").val("");
                    }
                    var times = $(this).data('times');
                    if (times == 0) {
                        $("#edit-time").val("");
                    } else {
                        $("#edit-time").val(times);
                    }

                });
           </script>

            <script>
                $('.modal-img-input').on('change', function () {
                    var fileName = $(this).val().split('\\').pop();
                    $(this).closest('.form-file').find('.modal-img-choose').addClass("selected").text(fileName);
                });
                $(document).on("click", ".btn-close", function (ev) {
                    ev.preventDefault();
                    $("#cat-id").val($(this).data('id'));
                });
                $(document).on("click", ".btn-edit", function (ev) {
                    ev.preventDefault();
                    $("#edit-id").val($(this).data('id'));
                    $("#edit-name").val($(this).data('name'));
                    $("#edit-desc").val($(this).data('desc'));
                    $("#edit-ty").val($(this).data('ty'));
                    $("#edit-ty").text($(this).data('typ'));
                    $("#edit-ct").val($(this).data('ct'));
                });
            </script>

            <script>
                var can_submit = 0;
                var element = document.getElementById("lbl-content");
                $(document).on("click", "#lbl", function (ev) {
                    ev.preventDefault();
                    can_submit = 0;
                    $("#lbl-modal").modal({
                        show: true,
                        backdrop: 'static',
                        keyboard: false
                    });
                    $("#modal-err").html('');
                    $("#modal-submit").text('Submit');
                    element.innerHTML =
                        '<div class="mb-3">' +
                        '<label class="form-label">How many users will be ranked?</label>' +
                        '<div class="input-group">' +
                        '<input id="modal-limit" type="text" class="form-control" name="balance_interval">' +
                        '<span class="input-group-text">users</span>' +
                        '</div>' +
                        '</div>';
                });

                $(document).on("input", "#modal-limit", function () {
                    this.value = Number(this.value.replace(/\D/g, ''));
                });
                var limit = 0;
                $(document).on("click", "#modal-submit", function (ev) {
                    ev.preventDefault();
                    if (can_submit == 1) {
                        var dta = {};
                        dta['limit'] = limit;
                        for (var i = 0; i < limit; i++) {
                            var key = 'rank_' + (i + 1);
                            dta[key] = $("#" + key).val();
                        }
                        $.ajax({
                            type: 'GET',
                            url: 'settings/leaderboard',
                            data: dta,
                            success: function (data) {
                                if (data.status == 1) {
                                    $("#modal-err").html('');
                                    element.innerHTML = '<div class="text-center">Update successfull.</div>';
                                    can_submit = 2;
                                    $("#modal-submit").text('Close dialog');
                                    $("#lbl").val(limit);
                                } else {
                                    $("#modal-err").html('<div class="alert alert-danger mx-3">' + data.message + '</div>');
                                }
                            },
                            error: function (request, status, error) {
                                alert(request.responseText);
                            }
                        });
                    } else if (can_submit == 0) {
                        limit = $("#modal-limit").val();
                        if (limit == 0) return;
                        var htmls = '<input type="hidden" name="limit" value="' + limit + '">';
                        for (var i = 0; i < limit; i++) {
                            htmls += addInput(i + 1);
                        }
                        element.innerHTML = htmls;
                        can_submit = 1;
                    } else if (can_submit == 2) {
                        $("#lbl-modal").modal('hide');
                    }
                });

                function addInput(id) {
                    return '<div class="mb-3">' +
                        '<label class="form-label">Percentage for rank ' + id + '</label>' +
                        '<div class="input-group">' +
                        '<input id="rank_' + id + '" type="text" class="form-control" name="balance_interval">' +
                        '<span class="input-group-text">percent</span>' +
                        '</div>' +
                        '</div>';
                }

            </script>

            <script>
                function getMessage() {
                    $.ajax({
                        url: "https://reapbucks.com/admin/chatquick.php",
                        method: "GET",
                        success: function (res) {
                            const data = JSON.parse(res);
                            let html = "";
                            data.msgs.forEach((msg) => {
                                const time = new Date(msg.updated_at).toLocaleString();
                                const isMine = msg.userid == $("#userid").val();
                                html += `
                                <div class="chat-message mb-2 ${isMine ? 'text-right' : 'text-left'}">
                                    <div><strong>${msg.name}</strong> <small>${time}</small></div>
                                    <div>${msg.message}</div>
                                    ${msg.is_staff ? `<a class='text-primary small' onclick='deleteMessage(${msg.id})'>X</a>` : ""}
                                </div>`;
                            });
                            $("#msg").html(html);
                            $("#msg-parent").scrollTop($("#msg-parent")[0].scrollHeight);
                        }
                    });
                }
                
                function sendMessage() {
                    const msg = $("#msg-input").val();
                    if (!msg.trim()) return;
                
                    $.ajax({
                        url: "https://reapbucks.com/admin/chat_send.php",
                        method: "POST",
                        data: { msg },
                        success: function (res) {
                            $("#msg-input").val("");
                            getMessage(); // Refresh chat
                        }
                    });
                }
                
                function deleteMessage(msgid) {
                    if (!confirm("Are you sure to delete this message?")) return;
                    $.ajax({
                        url: "https://reapbucks.com/admin/chat_del.php?id=" + msgid,
                        method: "GET",
                        success: function () {
                            getMessage();
                        }
                    });
                }
                
                function deleteAll() {
                    if (!confirm("Delete all messages?")) return;
                    $.ajax({
                        url: "https://reapbucks.com/admin/chat_delall.php",
                        method: "GET",
                        success: function () {
                            getMessage();
                        }
                    });
                }
                
                // Load messages on page load
                $(document).ready(getMessage);
           </script>

            <script>
                $(document).on("click", ".copy-event", function () {
                    var field = $(this).closest('.cevent').find('.cpy');
                    var copyText = field.text();
                    if (copyText == 'None') {
                        field.html('<span class="text-red">Nothing to copy!</span>')
                    } else {
                        var temp = $("<input>");
                        $("body").append(temp);
                        temp.val(copyText).select();
                        document.execCommand("copy");
                        temp.remove();
                        $(this).addClass('d-none');
                        field.html('<span class="text-blue">Text copied!</span>')
                    }
                });
                $('.config-input').on('change', function () {
                    var fileName = $(this).val().split('\\').pop();
                    $(this).closest('.form-file').find('.config-choose').addClass("selected").text(fileName);
                });
            </script>

    <script>
        $(document).on("click", ".yt_close", function (ev) {
            ev.preventDefault();
            $("#vid-id").val($(this).data('id'));
        });
    </script>

    <script>
        $(document).on("click", ".ppv_close", function (ev) {
            ev.preventDefault();
            $("#ppv-id").val($(this).data('id'));
        });
    </script>
    
    <script>
        $(document).on("click", ".open-send-local-del", function (ev) {
            ev.preventDefault();
            $("#send-local-id").val($(this).data('id'));
        });
    </script>

    <script>
        $(document).on("click", ".reject", function (ev) {
            ev.preventDefault();
            $("#ofr-id").val($(this).data('id'));
        });
        $(document).on("click", ".infos", function (ev) {
            ev.preventDefault();
            $("#info-msg").text($(this).data('msg'));
            var aa = $(this).data('scr');
            if (aa == '') {
                $("#info-scr").addClass('d-none');
            } else {
                $("#info-scr").attr("href", aa);
            }
        });
    </script>

    <script>
        $(document).on("click", ".btn-del", function (ev) {
            ev.preventDefault();
            $("#qs-id").val($(this).data('id'));
        });
        $(document).on("click", ".btn-edit", function (ev) {
            ev.preventDefault();
            $("#qs_id").val($(this).data('id'));
            $("#qs_qs").val($(this).data('qs'));
            $("#qs_op").text($(this).data('op'));
            $("#qs_ans").val($(this).data('ans'));
            $("#qs_time").val($(this).data('time'));
            $("#qs_sc").val($(this).data('sc'));
        });
        jQuery(document).ready(function () {
            'use strict';
            jQuery('#begin-date, #result-until').datetimepicker({
                format: 'H:i d/m/Y',
                step: 30,
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on("click", ".modalbtn", function (ev) {
            ev.preventDefault();
            var userid = $(this).data('userid');
            var reason = $(this).data('reason');
            document.getElementById('userid').value = userid;
            // document.getElementById('reasoning').value = reason;
            $("#edit-reason").attr('action', 'members-ban-edit.php?uid=' + userid);
            $(".modal-body #reasoning").text(reason);
        });

    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-active-users'), {
                chart: {
                    type: "bar",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                plotOptions: {
                    bar: {
                        columnWidth: '60%',
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val
                        }
                    }
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                    name: "Members",
                    data: [3, 1, 3, 3, 2, 2, 2, 1, 2, 1, 1, 4, 2, 1, 1, 2, 1, 1, 3, 2, 1, 4, 2, 1]
                }],
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: ["2025-03-10", "2025-03-11", "2025-03-12", "2025-03-13", "2025-03-14", "2025-03-15", "2025-03-16", "2025-03-17", "2025-03-18", "2025-03-20", "2025-03-21", "2025-03-22", "2025-03-23", "2025-03-24", "2025-03-25", "2025-03-27", "2025-03-28", "2025-03-29", "2025-03-30", "2025-03-31", "2025-04-03", "2025-04-04", "2025-04-07", "2025-04-08"],
                colors: ["#206bc4"],
                legend: {
                    show: false,
                },
            })).render();
        });
        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-leads-bg'), {
                chart: {
                    type: "area",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                fill: {
                    opacity: 1,
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "stepline",
                },
                series: [{
                    name: "Completed",
                    data: []
                }],
                grid: {
                    strokeDashArray: 4,
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [],
                colors: ["#ff922b"],
                legend: {
                    show: false,
                },
            })).render();
        });
        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-revenue-bg'), {
                chart: {
                    type: "area",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val
                        }
                    }
                },
                fill: {
                    opacity: .16,
                    type: 'solid'
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "USD",
                    data: []
                }],
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [],
                colors: ["#5eba00"],
                legend: {
                    show: false,
                },
            })).render();
        });

        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-withdrawn-bg'), {
                chart: {
                    type: "area",
                    fontFamily: 'inherit',
                    height: 40.0,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: .16,
                    type: 'solid'
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "smooth",
                },
                series: [{
                    name: "USD",
                    data: []
                }],
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0
                    },
                    tooltip: {
                        enabled: false
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: 'datetime',
                },
                yaxis: {
                    labels: {
                        padding: 4
                    },
                },
                labels: [],
                colors: ["#ff0000"],
                legend: {
                    show: false,
                },
            })).render();
        });
        document.addEventListener("DOMContentLoaded", function () {
            $('#map-world').vectorMap({
                map: 'world_en',
                backgroundColor: 'transparent',
                color: 'rgba(120, 130, 140, .1)',
                borderColor: 'transparent',
                scaleColors: ["#d2e1f3", "#206bc4"],
                normalizeFunction: 'polynomial',
                values: (chart_data = {
                    ad: 0, ae: 0, af: 0, ag: 0, ai: 0, al: 0, am: 0, an: 0, ao: 0, aq: 0, ar: 0, as: 0, at: 0, au: 4, aw: 0, az: 7, ba: 0, bb: 0, bd: 266, be: 0, bf: 0, bg: 1, bh: 0, bi: 0, bj: 0, bm: 0, bn: 0, bo: 3, br: 6, bs: 0, bt: 0, bv: 0, bw: 0, by: 0, bz: 0, ca: 3, cc: 0, cd: 0, cf: 0, cg: 0, ch: 0, ci: 0, ck: 0, cl: 0, cm: 0, cn: 1, co: 0, cr: 0, cs: 0, cu: 0, cv: 0, cx: 0, cy: 0, cz: 0, de: 0, dj: 0, dk: 1, dm: 0, do: 0, dz: 11, ec: 0, ee: 0, eg: 42, eh: 0, er: 0, es: 15, et: 0, fi: 0, fj: 0, fk: 0, fm: 0, fo: 0, fr: 3, ga: 0, gb: 9, gd: 0, ge: 1, gf: 0, gh: 0, gi: 0, gl: 0, gm: 0, gn: 0, gp: 0, gq: 0, gr: 0, gs: 0, gt: 6, gu: 0, gw: 0, gy: 0, hk: 0, hm: 0, hn: 1, hr: 0, ht: 0, hu: 0, id: 29, ie: 0, il: 5, in: 190, io: 0, iq: 0, ir: 0, is: 0, it: 5, jm: 0, jo: 0, jp: 0, ke: 0, kg: 0, kh: 7, ki: 0, km: 0, kn: 0, kp: 0, kr: 0, kw: 0, ky: 0, kz: 0, la: 0, lb: 0, lc: 0, li: 0, lk: 0, lr: 0, ls: 0, lt: 0, lu: 0, lv: 0, ly: 0, ma: 15, mc: 0, md: 0, mg: 0, mh: 0, mk: 1, ml: 0, mm: 0, mn: 0, mo: 0, mp: 0, mq: 0, mr: 0, ms: 0, mt: 0, mu: 0, mv: 0, mw: 0, mx: 7, my: 1, mz: 0, na: 0, nc: 0, ne: 0, nf: 0, ng: 47, ni: 0, nl: 7, no: 0, np: 0, nr: 0, nu: 0, nz: 0, om: 0, pa: 0, pe: 5, pf: 0, pg: 0, ph: 10, pk: 9, pl: 0, pm: 0, pn: 0, pr: 0, ps: 0, pt: 1, pw: 0, py: 0, qa: 0, re: 0, ro: 1, ru: 38, rw: 0, sa: 6, sb: 0, sc: 0, sd: 0, se: 0, sg: 0, sh: 0, si: 0, sj: 0, sk: 0, sl: 0, sm: 0, sn: 0, so: 0, sr: 0, st: 0, sv: 0, sy: 0, sz: 0, tc: 0, td: 0, tf: 0, tg: 0, th: 0, tj: 0, tk: 0, tl: 0, tm: 0, tn: 0, to: 0, tr: 26, tt: 0, tv: 0, tw: 2, tz: 0, ua: 0, ug: 0, um: 0, us: 110, uy: 0, uz: 0, va: 0, vc: 0, ve: 0, vg: 0, vi: 0, vn: 2, vu: 0, wf: 0, ws: 0, ye: 2, yt: 0, za: 19, zm: 0, zw: 0, all: 0, rs: 0, cw: 0
                }),
                onLabelShow: function (event, label, code) {
                    if (chart_data[code] > 0) {
                        label.append(': <strong>' + chart_data[code] + '</strong>');
                    }
                },
                onRegionClick: function (element, code) {
                    window.open("members?cc=" + code, "_self")
                }
            });
        });

    </script>

</body>

</html>