$(document).ready(function() {
	if (!document.getElementById('calendar')) {
		return;
	}

	// Crear y configurar el calendario
	(function(window, Calendar) {
		// Configurar lenguaje de la librería de tiempo
		moment.locale('es');
	
		// Contiene la información de las clases en pantalla
		var classesArray = [];
	
		var calendar = new Calendar('#calendar', {
			defaultView: 'month',
			usageStatistics: false,
			taskView: true,
			useCreationPopup: true,
			useDetailPopup: true,
			// Define plantillas personalizadas para algunas secciones del calendario
			template: {
			// Cambia la plantilla para los nombres de la semana
			// monthDayname: function(dayname) {
			//   return '<span class="calendar-week-dayname-name" style="text-transform: capitalize;">' + translateDay(dayname.label) +  '</span>';
			// },
			time: function(schedule) {
				return '<i class="fa fa-refresh"></i>' + moment(+(schedule.start)).format('LT') + ': ' + schedule.title;
			}
			},
			month: {
			daynames: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']
			}
		});
	
		calendar.on('beforeUpdateSchedule', function(event) {
			var schedule = event.schedule;
			var changes = event.changes;
	
			updateClass({
			scheduleId: schedule.id,
			calendarId: schedule.calendarId,
			changes: changes
			});
		});
	
		calendar.on('beforeDeleteSchedule', function(event) {
			var schedule = event.schedule;
	
			removeClass({
			scheduleId: schedule.id,
			calendarId: schedule.calendarId
			})  
		});
	
		calendar.on('beforeCreateSchedule', function(event) {
			var startTime = event.start;
			var endTime = event.end;
			var title = event.title;
			var isAllDay = event.isAllDay;
			var guide = event.guide;
			var triggerEventName = event.triggerEventName;
			
			var schedule = {
			id: getNewId(),    // TODO: Poner id de acuerdo al que asigne la BD
			calendarId: '1',
			title: title,
			category: 'time',
			start: startTime,
			end: endTime
			};
	
			addClass(schedule);
		});
	
		// Obtiene un nuevo id a partir de sumarle uno al mayor que esté en las clases actuales, realmente debería venir del resultado de la BD o ser nulo mientras se procesa y se incluye a la lista
		function getNewId() {
			if (classesArray.length < 1) return 1;
			return '' + ( +([...classesArray].sort((c1, c2) => +(c1.id) < +(c2.id) ? -1 : +(c1.id) > +(c2.id) ? 1 : 0).pop().id) + 1 );
		}
	
		// Funciones para utilizar en la interfaz
		function loadClasses(classes) {
			if (classes && classes.length) {
			classesArray = classes;
			calendar.clear();
			calendar.createSchedules(classesArray);
			}
		}
	
		function addClass(classData) {
			if (classData) {
			classesArray.push(classData);
			calendar.createSchedules([classData]);
			}
		}
	
		function updateClass(classData) {
			if (classData && classData.scheduleId && classData.calendarId) {
			let matchIdx = classesArray.findIndex(c => c.id === classData.scheduleId && c.calendarId === classData.calendarId);
	
			if (matchIdx >= 0) {
				match = classesArray[matchIdx];
				classesArray.splice(matchIdx, 1, {...match, ...classData.changes });
				calendar.updateSchedule(classData.scheduleId, classData.calendarId, classData.changes);
			}
			}
		}
	
		function removeClass(classData) {
			if (classData && classData.scheduleId && classData.calendarId) {
			let match = classesArray.find(c => c.id === classData.scheduleId && c.calendarId === classData.calendarId);
	
			if (match) {
				classesArray = classesArray.filter(c => c.id !== classData.scheduleId || c.calendarId !== classData.calendarId);
				calendar.deleteSchedule(classData.scheduleId, classData.calendarId);
			}
			}
		}
	
		function setNavigationListeners() {
			document.querySelector('#menu-navi').addEventListener('click', (e) => {
			var action = getDataAction(e.target);
	
			switch (action) {
				case 'move-prev':
				calendar.prev();
				break;
				case 'move-next':
				calendar.next();
				break;
				case 'move-today':
				calendar.today();
				break;
				default:
				return;
			}
	
			setRenderRangeText();
			});
		}
	
		function getDataAction(target) {
			return target.dataset ? target.dataset.action : target.getAttribute('data-action');
		}
	
		// TODO: Mostrar el mes activo?
		function setRenderRangeText() {
			var renderRange = document.getElementById('renderRange');
			var options = calendar.getOptions();
			var viewName = calendar.getViewName();
			var html = [];
			if (viewName === 'day') {
			html.push(moment(calendar.getDate().getTime()).format('MMM YYYY DD'));
			} else if (viewName === 'month' &&
			(!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
			html.push(moment(calendar.getDate().getTime()).format('MMM YYYY'));
			} else {
			html.push(moment(calendar.getDateRangeStart().getTime()).format('MMM YYYY DD'));
			html.push(' ~ ');
			html.push(moment(calendar.getDateRangeEnd().getTime()).format(' MMM DD'));
			}
			renderRange.innerHTML = html.join('');
		}
	
		// Activar eventos
		setRenderRangeText();
		setNavigationListeners();
	
		// Hacer pública la instancia
		window.classesCalendar = {
			loadClasses,
			addClass,
			updateClass,
			removeClass
		};
	})(window, tui.Calendar);  
});