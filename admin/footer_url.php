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
    <?php
        $chart_data = [];
        $query = mysqli_query($con, "
            SELECT LOWER(user_country) AS country_code, COUNT(*) AS total
            FROM offer_clicks
            GROUP BY country_code
        ");
        
        while ($row = mysqli_fetch_assoc($query)) {
            $code = $row['country_code'];
            $total = $row['total'];
            $chart_data[$code] = (int)$total;
        }
    ?>
    
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
        
        // Top countries
        document.addEventListener("DOMContentLoaded", function () {
             var chart_data = <?php echo json_encode($chart_data); ?>;
             
            $('#map-world').vectorMap({
                map: 'world_en',
                backgroundColor: 'transparent',
                color: 'rgba(120, 130, 140, .1)',
                borderColor: 'transparent',
                scaleColors: ["#d2e1f3", "#206bc4"],
                normalizeFunction: 'polynomial',
                values: chart_data,
                onLabelShow: function (event, label, code) {
                    if (chart_data[code]) {
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