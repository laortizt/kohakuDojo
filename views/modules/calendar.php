<?php
	require_once"./controller/controllerClass.php";
	$insClass= new controllerClass();
?>

<div class="row">
    <div class="col-12 col-m-12 col-sm-12">
        <div class="card">
            <div class="card-content">
            
                <form action="ajax/classAjax.php" method="post" autocomplete="off" class="formulario-ajax">
                    <div class="app-container" ng-app="dateTimeApp" ng-controller="dateTimeCtrl as ctrl" ng-cloak>
                        <div date-picker datepicker-title="Seleccionar Fecha" picktime="true" pickdate="true" pickpast="false" mondayfirst="false" custom-message="Ha seleccionado," selecteddate="ctrl.selected_date" updatefn="ctrl.updateDate(newdate)">
                            <div class="datepicker" ng-class="{
                                    'am': timeframe == 'am',
                                    'pm': timeframe == 'pm',
                                    'compact': compact
                                }">
                                <div class="datepicker-header">
                                    <div class="datepicker-title" ng-if="datepicker_title">{{ datepickerTitle }}</div>
                                    <div class="datepicker-subheader">{{ customMessage }} {{ selectedDay }} {{ monthNames[localdate.getMonth()] }} {{ localdate.getDate() }}, {{ localdate.getFullYear() }}</div>
                                </div>

                                <div class="datepicker-calendar">
                                    <div class="calendar-header">
                                        <div class="goback" ng-click="moveBack()" ng-if="pickdate">
                                            <svg width="30" height="30">
                                                <path fill="none" stroke="#0DAD83" stroke-width="3" d="M19,6 l-9,9 l9,9" />
                                            </svg>
                                        </div>

                                        <div class="current-month-container">{{ currentViewDate.getFullYear() }} {{ currentMonthName() }}</div>

                                        <div class="goforward" ng-click="moveForward()" ng-if="pickdate">
                                            <svg width="30" height="30">
                                                <path fill="none" stroke="#0DAD83" stroke-width="3" d="M11,6 l9,9 l-9,9" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="calendar-day-header">
                                        <span ng-repeat="day in days" class="day-label">{{ day.short }}</span>
                                    </div>

                                    <div class="calendar-grid" ng-class="{false: 'no-hover'}[pickdate]">
                                        <div ng-class="{'no-hover': !day.showday}" ng-repeat="day in month" class="datecontainer" ng-style="{'margin-left': calcOffset(day, $index)}" track by $index>
                                            <div class="datenumber" ng-class="{'day-selected': day.selected }" ng-click="selectDate(day)">
                                                {{ day.daydate }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timepicker" ng-if="picktime == 'true'">
                                    <div ng-class="{'am': timeframe == 'am', 'pm': timeframe == 'pm' }">
                                        <div class="timepicker-container-outer" selectedtime="time" timetravel>
                                            <div class="timepicker-container-inner">
                                                <div class="timeline-container" ng-mousedown="timeSelectStart($event)" sm-touchstart="timeSelectStart($event)">
                                                    <div class="current-time">
                                                        <div class="actual-time">{{ time }}</div>
                                                    </div>

                                                    <div class="timeline"></div>

                                                    <div class="hours-container">
                                                        <div class="hour-mark" ng-repeat="hour in getHours() track by $index"></div>
                                                    </div>
                                                </div>
                                                
                                                <div class="hour-container">
                                                    <div class="display-time">
                                                        <div class="decrement-time" ng-click="adjustTime('decrease')">
                                                            <svg width="24" height="24">
                                                                <path stroke="white" stroke-width="2" d="M8,12 h8" />
                                                            </svg>
                                                        </div>
                                                        <div class="time" ng-class="{'time-active': edittime.active}">
                                                            <input type="text" class="time-input" ng-model="edittime.input" ng-keydown="changeInputTime($event)" ng-focus="edittime.active = true; edittime.digits = [];" ng-blur="edittime.active = false" />
                                                            <div class="formatted-time">{{ edittime.formatted }}</div>
                                                        </div>
                                                        <div class="increment-time" ng-click="adjustTime('increase')">
                                                            <svg width="24" height="24">
                                                                <path stroke="white" stroke-width="2" d="M12,7 v10 M7,12 h10" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="am-pm-container">
                                                        <div class="am-pm-button" ng-click="changetime('am');">am</div>
                                                        <div class="am-pm-button" ng-click="changetime('pm');">pm</div>
                                                    </div>
                                                </div>

                                                <div class="instructor-container col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-6">Instructor:</label>
                                                        <?php echo $insClass->list_teachers_controller()?>
                                                        <!-- INCLUIR TABLA INSTRUCTOR
                                                        <div class="select-instructor col-sm-6" name="select-instructor" id="teacher">
                                                        
                                                        </div> -->
                                                    </div>
                                                </div>

                                                <div class="topic-container col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-6">Tema:</label>

                                                        <input class="select-tema col-sm-6" name="topic" id="topic" required="">
                                                        </input>
                                                    </div>
                                                </div>

                                                <div hidden class="date-container col-sm-12">
                                                    <div class="row">
                                                        <label class="col-sm-6">Fecha:</label>
                                                        <input class="select-tema col-sm-6" name="class-date" id="class-date" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="buttons-container">
                                        <!-- <div class="cancel-button">Cancelar</div> -->
                                        <input type="submit" class="save-button" name="create-class" value="Guardar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="RespuestaAjax"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- <script src="<?php echo SERVERURL; ?>assets/script/calendar.js"></script> -->
