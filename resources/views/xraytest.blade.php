<style>
    div.control-label {
        text-align: left !important;
    }
</style>
<?php
$time_array = array(
    '00:00:00' => '12:00 AM', '00:05:00' => '12:05 AM', '00:10:00' => '12:10 AM', '00:15:00' => '12:15 AM', '00:20:00' => '12:20 AM', '00:25:00' => '12:25 AM', '00:30:00' => '12:30 AM', '00:35:00' => '12:35 AM', '00:40:00' => '12:40 AM', '00:45:00' => '12:45 AM', '00:50:00' => '12:50 AM', '00:55:00' => '12:55 AM',
    '01:00:00' => '01:00 AM', '01:05:00' => '01:05 AM', '01:10:00' => '01:10 AM', '01:15:00' => '01:15 AM', '01:20:00' => '01:20 AM', '01:25:00' => '01:25 AM', '01:30:00' => '01:30 AM', '01:35:00' => '01:35 AM', '01:40:00' => '01:40 AM', '01:45:00' => '01:45 AM', '01:50:00' => '01:50 AM', '01:55:00' => '01:55 AM',
    '02:00:00' => '02:00 AM', '02:05:00' => '02:05 AM', '02:10:00' => '02:10 AM', '02:15:00' => '02:15 AM', '02:20:00' => '02:20 AM', '02:25:00' => '02:25 AM', '02:30:00' => '02:30 AM', '02:35:00' => '02:35 AM', '02:40:00' => '02:40 AM', '02:45:00' => '02:45 AM', '02:50:00' => '02:50 AM', '02:55:00' => '02:55 AM',
    '03:00:00' => '03:00 AM', '03:05:00' => '03:05 AM', '03:10:00' => '03:10 AM', '03:15:00' => '03:15 AM', '03:20:00' => '03:20 AM', '03:25:00' => '03:25 AM', '03:30:00' => '03:30 AM', '03:35:00' => '03:35 AM', '03:40:00' => '03:40 AM', '03:45:00' => '03:45 AM', '03:50:00' => '03:50 AM', '03:55:00' => '03:55 AM',
    '04:00:00' => '04:00 AM', '04:05:00' => '04:05 AM', '04:10:00' => '04:10 AM', '04:15:00' => '04:15 AM', '04:20:00' => '04:20 AM', '04:25:00' => '04:25 AM', '04:30:00' => '04:30 AM', '04:35:00' => '04:35 AM', '04:40:00' => '04:40 AM', '04:45:00' => '04:45 AM', '04:50:00' => '04:50 AM', '04:55:00' => '04:55 AM',
    '05:00:00' => '05:00 AM', '05:05:00' => '05:05 AM', '05:10:00' => '05:10 AM', '05:15:00' => '05:15 AM', '05:20:00' => '05:20 AM', '05:25:00' => '05:25 AM', '05:30:00' => '05:30 AM', '05:35:00' => '05:35 AM', '05:40:00' => '05:40 AM', '05:45:00' => '05:45 AM', '05:50:00' => '05:50 AM', '05:55:00' => '05:55 AM',
    '06:00:00' => '06:00 AM', '06:05:00' => '06:05 AM', '06:10:00' => '06:10 AM', '06:15:00' => '06:15 AM', '06:20:00' => '06:20 AM', '06:25:00' => '06:25 AM', '06:30:00' => '06:30 AM', '06:35:00' => '06:35 AM', '06:40:00' => '06:40 AM', '06:45:00' => '06:45 AM', '06:50:00' => '06:50 AM', '06:55:00' => '06:55 AM',
    '07:00:00' => '07:00 AM', '07:05:00' => '07:05 AM', '07:10:00' => '07:10 AM', '07:15:00' => '07:15 AM', '07:20:00' => '07:20 AM', '07:25:00' => '07:25 AM', '07:30:00' => '07:30 AM', '07:35:00' => '07:35 AM', '07:40:00' => '07:40 AM', '07:45:00' => '07:45 AM', '07:50:00' => '07:50 AM', '07:55:00' => '07:55 AM',
    '08:00:00' => '08:00 AM', '08:05:00' => '08:05 AM', '08:10:00' => '08:10 AM', '08:15:00' => '08:15 AM', '08:20:00' => '08:20 AM', '08:25:00' => '08:25 AM', '08:30:00' => '08:30 AM', '08:35:00' => '08:35 AM', '08:40:00' => '08:40 AM', '08:45:00' => '08:45 AM', '08:50:00' => '08:50 AM', '08:55:00' => '08:55 AM',
    '09:00:00' => '09:00 AM', '09:05:00' => '09:05 AM', '09:10:00' => '09:10 AM', '09:15:00' => '09:15 AM', '09:20:00' => '09:20 AM', '09:25:00' => '09:25 AM', '09:30:00' => '09:30 AM', '09:35:00' => '09:35 AM', '09:40:00' => '09:40 AM', '09:45:00' => '09:45 AM', '09:50:00' => '09:50 AM', '09:55:00' => '09:55 AM',
    '10:00:00' => '10:00 AM', '10:05:00' => '10:05 AM', '10:10:00' => '10:10 AM', '10:15:00' => '10:15 AM', '10:20:00' => '10:20 AM', '10:25:00' => '10:25 AM', '10:30:00' => '10:30 AM', '10:35:00' => '10:35 AM', '10:40:00' => '10:40 AM', '10:45:00' => '10:45 AM', '10:50:00' => '10:50 AM', '10:55:00' => '10:55 AM',
    '11:00:00' => '11:00 AM', '11:05:00' => '11:05 AM', '11:10:00' => '11:10 AM', '11:15:00' => '11:15 AM', '11:20:00' => '11:20 AM', '11:25:00' => '11:25 AM', '11:30:00' => '11:30 AM', '11:35:00' => '11:35 AM', '11:40:00' => '11:40 AM', '11:45:00' => '11:45 AM', '11:50:00' => '11:50 AM', '11:55:00' => '11:55 AM',
    '12:00:00' => '12:00 PM', '12:05:00' => '12:05 PM', '12:10:00' => '12:10 PM', '12:15:00' => '12:15 PM', '12:20:00' => '12:20 PM', '12:25:00' => '12:25 PM', '12:30:00' => '12:30 PM', '12:35:00' => '12:35 PM', '12:40:00' => '12:40 PM', '12:45:00' => '12:45 PM', '12:50:00' => '12:50 AM', '12:55:00' => '12:55 AM',
    '13:00:00' => '01:00 PM', '13:05:00' => '01:05 PM', '13:10:00' => '01:10 PM', '13:15:00' => '01:15 PM', '13:20:00' => '01:20 PM', '13:25:00' => '01:25 PM', '13:30:00' => '01:30 PM', '13:35:00' => '01:35 PM', '13:40:00' => '01:40 PM', '13:45:00' => '01:45 PM', '13:50:00' => '01:50 PM', '13:55:00' => '01:55 PM',
    '14:00:00' => '02:00 PM', '14:05:00' => '02:05 PM', '14:10:00' => '02:10 PM', '14:15:00' => '02:15 PM', '14:20:00' => '02:20 PM', '14:25:00' => '02:25 PM', '14:30:00' => '02:30 PM', '14:35:00' => '02:35 PM', '14:40:00' => '02:40 PM', '14:45:00' => '02:45 PM', '14:50:00' => '02:50 PM', '14:55:00' => '02:55 PM',
    '15:00:00' => '03:00 PM', '15:05:00' => '03:05 PM', '15:10:00' => '03:10 PM', '15:15:00' => '03:15 PM', '15:20:00' => '03:20 PM', '15:25:00' => '03:25 PM', '15:30:00' => '03:30 PM', '15:35:00' => '03:35 PM', '15:40:00' => '03:40 PM', '15:45:00' => '03:45 PM', '15:50:00' => '03:50 PM', '15:55:00' => '03:55 PM',
    '16:00:00' => '04:00 PM', '16:05:00' => '04:05 PM', '16:10:00' => '04:10 PM', '16:15:00' => '04:15 PM', '16:20:00' => '04:20 PM', '16:25:00' => '04:25 PM', '16:30:00' => '04:30 PM', '16:35:00' => '04:35 PM', '16:40:00' => '04:40 PM', '16:45:00' => '04:45 PM', '16:50:00' => '04:50 PM', '16:55:00' => '04:55 PM',
    '17:00:00' => '05:00 PM', '17:05:00' => '05:05 PM', '17:10:00' => '05:10 PM', '17:15:00' => '05:15 PM', '17:20:00' => '05:20 PM', '17:25:00' => '05:25 PM', '17:30:00' => '05:30 PM', '17:35:00' => '05:35 PM', '17:40:00' => '05:40 PM', '17:45:00' => '05:45 PM', '17:50:00' => '05:50 PM', '17:55:00' => '05:55 PM',
    '18:00:00' => '06:00 PM', '18:05:00' => '06:05 PM', '18:10:00' => '06:10 PM', '18:15:00' => '06:15 PM', '18:20:00' => '06:20 PM', '18:25:00' => '06:25 PM', '18:30:00' => '06:30 PM', '18:35:00' => '06:35 PM', '18:40:00' => '06:40 PM', '18:45:00' => '06:45 PM', '18:50:00' => '06:50 PM', '18:55:00' => '06:55 PM',
    '19:00:00' => '07:00 PM', '19:05:00' => '07:05 PM', '19:10:00' => '07:10 PM', '19:15:00' => '07:15 PM', '19:20:00' => '07:20 PM', '19:25:00' => '07:25 PM', '19:30:00' => '07:30 PM', '19:35:00' => '07:35 PM', '19:40:00' => '07:40 PM', '19:45:00' => '07:45 PM', '19:50:00' => '07:50 PM', '19:55:00' => '07:55 PM',
    '20:00:00' => '08:00 PM', '20:05:00' => '08:05 PM', '20:10:00' => '08:10 PM', '20:15:00' => '08:15 PM', '20:20:00' => '08:20 PM', '20:25:00' => '08:25 PM', '20:30:00' => '08:30 PM', '20:35:00' => '08:35 PM', '20:40:00' => '08:40 PM', '20:45:00' => '08:45 PM', '20:50:00' => '08:50 PM', '20:55:00' => '08:55 PM',
    '21:00:00' => '09:00 PM', '21:05:00' => '09:05 PM', '21:10:00' => '09:10 PM', '21:15:00' => '09:15 PM', '21:20:00' => '09:20 PM', '21:25:00' => '09:25 PM', '21:30:00' => '09:30 PM', '21:35:00' => '09:35 PM', '21:40:00' => '09:40 PM', '21:45:00' => '09:45 PM', '21:50:00' => '09:50 PM', '21:55:00' => '09:55 PM',
    '22:00:00' => '10:00 PM', '22:05:00' => '10:05 PM', '22:10:00' => '10:10 PM', '22:15:00' => '10:15 PM', '22:20:00' => '10:20 PM', '22:25:00' => '10:25 PM', '22:30:00' => '10:30 PM', '22:35:00' => '10:35 PM', '22:40:00' => '10:40 PM', '22:45:00' => '10:45 PM', '22:50:00' => '10:50 PM', '22:55:00' => '10:55 PM',
    '23:00:00' => '11:00 PM', '23:05:00' => '11:05 PM', '23:10:00' => '11:10 PM', '23:15:00' => '11:15 PM', '23:20:00' => '11:20 PM', '23:25:00' => '11:25 PM', '23:30:00' => '11:30 PM', '23:35:00' => '11:35 PM', '23:40:00' => '11:40 PM', '23:45:00' => '11:45 PM', '23:50:00' => '11:50 PM', '23:55:00' => '11:55 PM',

);
?>
<script>
    $(function () {
        var pickerOpts = {
            format: 'Y-m-d',
            //timepicker:true,
            // datepicker:true,
            changeMonth: true,
            changeYear: true,
            // showSeconds: true,
            showMonthAfterYear: true,
        }
    });
    $('#TestDate').datepicker({
        dateFormat: "mm/dd/yy",
    });

</script>
<script>

    function changeValues(did) {

        var dateValue = $("#TestDate").val();
        var hid = $("#hospitalId").val();
        var did = $("#doctorId").val();

        if (did != "Select Doctor") {

            var new_appointment_date = dateValue;
            var prev_appointment_date = $("input#prev_appointment_date").val();

            var date1 = new Date(new_appointment_date);
            var date2 = new Date(prev_appointment_date);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

            //alert(diffDays);


            if (diffDays <= 15) {
                $("#paymentTypeInfo").hide();

                $('input#payment1').attr('required', false);
                $('input#payment2').attr('required', false);
                $('input#fee').attr('required', false);

            }
            else {
                $("#paymentTypeInfo").show();

                $('input#payment1').attr('required', true);
                $('input#payment2').attr('required', true);
                $('input#fee').attr('required', true);

            }


            var BASEURL = "{{ URL::to('/') }}/";
            var status = 1;
            var callurl = BASEURL + 'rest/api/appointmenttimes';


            var d = new Date();
            var h = (d.getHours() < 10 ? '0' : '') + d.getHours();
            var m = (d.getMinutes() < 10 ? '0' : '') + d.getMinutes();
            var s = (d.getSeconds() < 10 ? '0' : '') + d.getSeconds();
            var t = h + ":" + m + ":" + s;
            var timeValue = h + ":" + m;


            $.ajax({
                url: callurl,
                type: "get",
                data: {"date": dateValue, "time": timeValue, "status": status, "doctorId": did, "hospitalId": hid},
                success: function (data) {
                    console.log(data);

                    if (data.result['result'] == "Doctor Is Not Available") {
                        alert(data.result['result']);
                        var terms = '<option value="">--Choose Time--</option>';
                        $("#examinationTime").html(terms);
                    } else {

                        var terms = '<option value="">--Choose Time--</option>';
                        $.each(data.result, function (index, value) {
                            terms += '<option value="' + index + '">' + value + '</option>';
                        });
                        $("#examinationTime").html(terms);
                    }

                }
            });
        } else {
            alert("Please Select Doctor");
        }


    }
    function loaddoctor(hid) {
        var BASEURL = "{{ URL::to('/') }}/";
        var did=$("#doctorId").val();
        var date=$("#TestDate").val();
        //alert(date);
        var status = 1;
        var callurl = BASEURL + '/hospital/'+hid+'/HospitalDoctors';
        //  alert(callurl);
        $.ajax({
            url: callurl,
            type: "get",
            data: {"id": hid, "status": status},
            success: function (data) {

                var list = "<option value=''>Select Doctor</option>";
                for (var i = 0; i < data.length; i++) {

                    list = list + "<option value='" + data[i]['doctor_id'] + "'>" + data[i]['name'] + "</option>";
                }
                $("#doctorId").html(list);
            }


        });
    }
    function submitForm() {


        var hospitalId= $('#hospitalId').val();
        var doctorId= $('#doctorId').val();
        // localStorage.setItem('hospitalId', hospitalId);
        // localStorage.setItem('doctorId', doctorId);
        localStorage.hospitalId = hospitalId;
        localStorage.doctorId = doctorId;
        var sthospitalId = localStorage.hospitalId;
        var stdoctorId = localStorage.doctorId;

        if(sthospitalId==""&&hospitalId==""){
            alert("please select Hospital");
            return false;
        }else  if(stdoctorId==""&&doctorId){
            alert("please select Doctor");
            return false;
        }else{
            return confirm('Do you really want to submit the form?');
        }


    }

</script>
<div class="container">

    <div class="row">
        <div class="col-sm-7 col-md-offset-2"></div>
        <div class="col-sm-8">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <style>
                        form.display label.control-label {
                            text-align: left;
                        }
                    </style>

                    @if(count($xrayExaminations)>0)

                        <form action="{{URL::to('/')}}/lab/rest/patient/xraytestresults" role="form" method="POST" onsubmit="return submitForm(this);" id="xray" class="form-horizontal ">



                            <div class="form-group">
                                <label class="col-sm-4 control-label">Select Hospital</label>
                                <div class="col-sm-8">
                                    <select name="hospitalId" id="hospitalId" onchange="loaddoctor()"  class="form-control input-md" placeholder="Hospital" required="required">
                                        <option value="">Select Hospital</option>
                                        @foreach ($hospitals as $val)

                                            <option value="{{ $val['hospital_id'] }}">{{ $val['hospital_name'] }}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" >Select Doctor</label>
                                <div class="col-sm-8">
                                    <select name="doctorId" id="doctorId" onchange="changeValues(this.value)"  class="form-control input-md" placeholder="Hospital">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Test Date</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="examinationDate" id="TestDate" value="{{date('Y-m-d')}}" style="line-height: 20px;" required="required" onchange="javascript:UpdateTestDates(this.value);" />
                                    @if ($errors->has('examinationDate'))<p class="error" style="">{!!$errors->first('examinationDate')!!}</p>@endif
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control" name="examinationTime" id="examinationTime"
                                            required="required">

                                        <option value=""> --:----</option>
                                        @foreach($time_array as $time_value)
                                            <?php $key=array_keys($time_array,$time_value); ?>
                                            <option value="{{$key[0]}}"> {{$time_value}} </option>
                                        @endforeach

                                    </select>            @if ($errors->has('examinationTime'))<p class="error" style="">{!!$errors->first('examinationTime')!!}</p>@endif
                                </div>
                            </div>
                            <?php $i=0; ?>
                            @foreach($xrayExaminationCategory as $key => $xrayExaminationCategoryValue)
                                @if($key!="Other")
                                    <div class="form-group">
                                        <label class="col-sm-12 control-label" style="text-align: left; font-size: 14px;" >{{$xrayExaminationCategoryValue}}</label>
                                    </div>

                                    @foreach($xrayExaminations as $xrayExaminationsValue)
                                        @if($xrayExaminationsValue->category== $key)

                                            <div class="form-group col-sm-6">
                                                <label class="col-sm-8 control-label">{{$xrayExaminationsValue->examination_name}}</label>
                                                <div class="col-sm-4">
                                                    <input type="hidden" class="form-control" name="xrayExaminations[{{$i}}][xrayExaminationId]" value="{{$xrayExaminationsValue->id}}" required="required" />
                                                    <input type="hidden" class="form-control" name="xrayExaminations[{{$i}}][xrayExaminationDate]" id="TestDates" value="{{date('Y-m-d')}}" required="required" />
                                                    <input type="hidden" class="form-control" name="xrayExaminations[{{$i}}][examinationTime]" id="TestTimes" value="{{date('h:i:s')}}" required="required" />
                                                    <input type="checkbox" class="form-controlX" name="xrayExaminations[{{$i}}][xrayExaminationName]" value="{{$xrayExaminationsValue->examination_name}}" style="height: 20px;width: 20px;margin: 8px 0px 0px 0px;" />
                                                    <?php /* ?>
<div class="radio radio-info radio-inline">
<input type="radio" id="xrayExaminations{{$xrayExaminationsValue->id}}1" value="1" name="xrayExaminations[{{$i}}][isValueSet]">
<label for="xrayExaminations{{$xrayExaminationsValue->id}}1"> Yes </label>
</div>
<div class="radio radio-inline">
<input type="radio" id="xrayExaminations{{$xrayExaminationsValue->id}}2" value="0" name="xrayExaminations[{{$i}}][isValueSet]" checked="checked">
<label for="xrayExaminations{{$xrayExaminationsValue->id}}2"> No </label>
</div>
<?php */ ?>
                                                </div>
                                            </div>

                                            <?php $i++; ?>
                                        @endif


                                    @endforeach
                                @endif
                            @endforeach

                            <div class="col-sm-12 form-group">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-6">
                                    <input type="hidden" class="form-control" name="patientId" value="{{session('patient_id')}}" required="required" />
                                    <input type="submit" name="addblood" value="Save" class="btn btn-success"/>
                                    <input type="button" value="Cancel" class="btn btn-info waves-effect waves-light" onclick="window.history.back()"/>

                                </div>
                            </div>
                        </form>
                    @endif

                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div> <!-- End row -->

</div>
<script>

    function submitForm() {
        return confirm('Do you really want to submit the form?');
    }
</script>