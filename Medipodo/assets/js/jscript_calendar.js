//const modalCalendar = document.getElementById('modalCalendar');
//var frm = document.getElementById('contact') || null;



class Calendar{
    constructor({
        element,
        defaultDate
    }){
        if(element instanceof HTMLElement){
            this.element = element;
        }else{
            throw new Error("element deberia ser HTMLElement");
        }

        if(defaultDate instanceof Date){
            this.defaultDate = defaultDate;
        }else{
            this.defaultDate = new Date();
        }

        this.#init();
    }
    
    //private properties
    #year;
    #month;//month start from 1
    #date;
    #dateString;
    //private methods
    #init = () => {
        const defaultYear = this.defaultDate.getFullYear();
        //month start from 1
        const defaultMonth = this.defaultDate.getMonth() + 1;
        const defaultDate = this.defaultDate.getDate();
        this.#setDate(defaultYear, defaultMonth, defaultDate );
        this.#listenEvents();
    }

    #listenEvents = () => {
        //DOMs
        const lastYearButton = this.element.querySelector('.lastYear');
        const lastMonthButton = this.element.querySelector('.lastMonth');
        const nextMonthButton = this.element.querySelector('.nextMonth');
        const nextYearButton = this.element.querySelector('.nextYear');
        //click last year 
        lastYearButton.addEventListener('click', ()=>{
            this.#year--;
            this.#setDate(this.#year, this.#month);
        });
        //click next year 
        nextYearButton.addEventListener('click', ()=>{
            this.#year++;
            this.#setDate(this.#year, this.#month);
        });
        //click last month 
        lastMonthButton.addEventListener('click', ()=>{
            if(this.#month === 1){
                this.#month = 12;
                this.#year--;
            }else {
                this.#month--;
            }
            this.#setDate(this.#year, this.#month);
        });
        //click next month 
        nextMonthButton.addEventListener('click', ()=>{
            if(this.#month === 12){
                this.#month = 1;
                this.#year++;
            }else {
                this.#month++;
            }
            this.#setDate(this.#year, this.#month);
        });
        //click dates
        this.element.addEventListener('click', (e) => {
            if (e.target.classList.contains('date')){
                //console.log(e.target.title); //si hace click en la fecha se marca // buscar como se puede usar con php
                const params = e.target.title.split('-').map(str => parseInt(str,10));
                this.#setDate(...params);                 
                //modalCalendar.style.display = "block";
                //document.getElementById("demo").innerHTML = e.target.title; //no es necesario
                // if(frm) {
                //     frm.action = 'conexion/calAdminConnect.php?F='+ e.target.title;
                // }

                var elmId = $(".calendar_sec").attr("id");//la clase calendar_sec que pertenece a podologo.php como index.php regresa el valor del id, que son distintos respectivamente
                var name_calendar = $(".calendar_sec").attr("name"); 
                //alert( name_calendar);
                if(elmId == "calendar_secP"){
                    //alert("es la pagina de podologo");
                    location.href='agendacionAdmin.php?fecha=' + e.target.title;
                }else if(elmId == "calendar_sec" && name_calendar == ""){ //es cuando index pero solo es del publico sin que lo vea el podologo
                    //alert("es la pagina de index");
                    location.href='agendacionPublico.php?fecha=' + e.target.title;
                }else if(elmId == "calendar_sec" && name_calendar == "admin"){ // es cuando es index pero lo esta viendo el podologo
                    location.href='agendacionPublico.php?fecha=' + e.target.title +'&admin=admin';
                }
            }
        });
    }

    #setDate = (year, month, date) => {
        this.#year = year;
        this.#month = month;
        this.#date = date;
        // the only place to do renders
        this.#renderCurrentDate();
        this.#renderDates();
    }

    #renderCurrentDate = () => {
        const currentDateEL = this.element.querySelector('.currentDate');
        this.#dateString = this.#getDateString(this.#year, this.#month, this.#date);
        currentDateEL.textContent = this.#dateString;
    }

    #getDateString = (year, month, date) => {
        if(date){
            return `${year}-${month}-${date}`;
        }else{
            return `${year}-${month}`;
        }
    }

    #renderDates = () => {
        const datesEL = this.element.querySelector('.dates');
        //clear before render
        datesEL.innerHTML = '';

        const dayCountInCurrentMonth = this.#getDayCount(this.#year, this.#month);
        const firstDayInCurrentMonth = this.#getFirstDay();

        const { lastMonth, yearOfLastMonth, dayCountOfLastMonth} = this.#getLastMonthInfo();
        const { nextMonth, yearOfNextMonth} = this.#getNextMonthInfo();

        for(let i = 1; i <= 42; i++){

            const dateEL = document.createElement('button');
            dateEL.classList.add('date');
            let date;
            let dateString;

            if(firstDayInCurrentMonth > 1 && i < firstDayInCurrentMonth){
                //show dates in last month aparecen las ultimas fechas del mes anterior
                date = dayCountOfLastMonth - (firstDayInCurrentMonth - i) + 1;
                dateString = this.#getDateString(yearOfLastMonth,  lastMonth, date);
            } else if(i >= dayCountInCurrentMonth + firstDayInCurrentMonth){
                //show dates in next month aparecen las fechas del mes siguiente
                date = i - (dayCountInCurrentMonth + firstDayInCurrentMonth) + 1;
                dateString = this.#getDateString(yearOfNextMonth, nextMonth, date);
            } else {
                //show dates in current month aparecen las fechas del centro
                date = i -firstDayInCurrentMonth + 1;
                dateString = this.#getDateString(this.#year, this.#month, date);
                dateEL.classList.add('currentMonth'); //crea una clase
                if(date === this.#date){
                    dateEL.classList.add('selected');// crea una clase para usarla en css, ver si se puede usar con php
                }
            }
            dateEL.textContent = date;
            dateEL.title = dateString;
            datesEL.append(dateEL);
        }
    }

    #getLastMonthInfo = () => {
        let lastMonth = this.#month -1;
        let yearOfLastMonth = this.#year;
        if(lastMonth === 0 ){
            lastMonth = 12;
            yearOfLastMonth -= 1;
        }
        const dayCountOfLastMonth = this.#getDayCount(yearOfLastMonth, lastMonth);

        return {
            lastMonth,
            yearOfLastMonth,
            dayCountOfLastMonth
        }
    }

    #getNextMonthInfo = () =>{
        let nextMonth = this.#month + 1;
        let yearOfNextMonth = this.#year;
        if(nextMonth === 13){
            nextMonth = 1;
            yearOfNextMonth += 1;
        }
        let dayCountInNextMonth = this.#getDayCount(yearOfNextMonth, nextMonth);

        return {
            nextMonth, 
            yearOfNextMonth,
            dayCountInNextMonth
        }
    }


    /**
     * get day count in a specific month by returning the last date of that month
     * @param {number} year year number
     * @param {number} month month number that start from 1
     * @returns 
     */
    #getDayCount = (year, month) => {
        return new Date(year, month, 0).getDate();
    }

    #getFirstDay = () =>{
        let day = new Date(this.#year, this.#month -1, 1).getDay();
        // day of sunday is 0, use 7 for calculation
        return day === 0 ? 7 : day;
    }

}