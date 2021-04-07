var instructors = [
  { id: '1', name: 'Antonio López' },
  { id: '2', name: 'Alejandro Martinez' },
  { id: '3', name: 'Camilo Torres' }
];

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
      // Cambia la plantilla para mostrar una clase
      time: function(schedule) {
        return '<i class="fa fa-refresh"></i>' + moment(+(schedule.start)).format('LT') + ': ' + schedule.title;
      },
      popupRegister: function() { return 'Registrarse'; },
      popupEdit: function() { return 'Editar'; },
      popupDelete: function() { return 'Borrar'; }
    },
    month: {
      daynames: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']
    },
    calendars: [
      {
        id: '1',
        name: 'Clases',
        isBasic: true,
        instructors: instructors
      }
    ]
  });

  calendar.on('beforeRegisterSchedule', function(event) {
    console.log('beforeRegisterSchedule', event);
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
    console.log(event);

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
      end: endTime,
      raw: {
        instructor: event.raw.instructor || instructors[0]
      }
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

  // Mostrar el mes activo
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




// Usar el calendario
(function() {
  // Llamar esta función con la información de las clases
  classesCalendar.loadClasses([
    {
      id: '1',
      calendarId: '1',
      title: 'Clase de armas',
      category: 'time',
      dueDateClass: '',
      start: '2021-04-07T17:00:00-05:00',
      end: '2021-04-07T19:00:00-05:00',
      raw: {
        instructor: instructors[0]
      },
    },
    {
      id: '2',
      calendarId: '1',
      title: 'Clase de proyecciones',
      category: 'time',
      dueDateClass: '',
      start: '2021-04-10T18:00:00-05:00',
      end: '2021-04-10T20:00:00-05:00',
      // TODO: Cómo definirlo para cada tipo de rol
      isReadOnly: true,    // schedule is read-only
      raw: {
        instructor: instructors[1]
      },
    }
  ]);

  // Llamar cuando se cree una clase
  classesCalendar.addClass({
    id: '3',
    calendarId: '1',
    title: 'Clase de agarres',
    category: 'time',
    dueDateClass: '',
    start: '2021-04-17T09:00:00-05:00',
    end: '2021-04-17T12:00:00-05:00',
    raw: {
      instructor: instructors[1]
    },
  });

  // Llamar cuando se quiera modificar una clase, ej: 5s después de crearla
  // setTimeout(() => {
  //   classesCalendar.updateClass({
  //     scheduleId: '3',
  //     calendarId: '1',
  //     changes: {
  //       start: '2021-04-18T10:00:00-05:00',
  //       end: '2021-04-18T12:00:00-05:00',
  //       raw: {
  //         instructor: instructors[0]
  //       },
  //     }
  //   });
  // }, 5000);

  // Llamar cuando se quiera modificar una clase, ej: 10s después de crearla
  // setTimeout(() => {
  //   classesCalendar.removeClass({
  //     scheduleId: '2',
  //     calendarId: '1'
  //   });
  // }, 10000);
})();