const button = document.querySelector('.button_new')
const new_task = document.querySelector('.new_task')
let tasks_to_do = document.getElementById('field')
let tasks_done = document.getElementById('field_done')
const search_val = document.querySelector('input.search_task')
let pasuje = []
const to_do = new Tasks()
const to_doJ = []
const doneJ = []
const done = new Tasks()
let i

function search(e) {
    const all_tasks = [...document.querySelectorAll('.task')]
    all_tasks.forEach(element => {
        element.classList.remove("wid")
    });
    value = e.target.value
    pasuje = all_tasks.filter(element => !element.textContent.split(" ")[0].includes(value))
    pasuje.forEach(element => {
        element.classList.add("wid")
    });
    console.log('zadania')

}

function remove_task() {
    to_doJ.splice(i, 1);
    console.log(to_doJ);
    this.parentNode.classList.add('done')
    const all_tasks = document.querySelectorAll('.task')
    all_tasks.forEach((element, index) => {
        if (element.classList[1] == "done") {
            done.add_new_task(to_do.getTasks()[index].getValue(), "-")
            to_do.remove_task(index);
            display()
        }
    });

}

function display() {
    i = -1;
    while (tasks_to_do.firstChild) {
        tasks_to_do.removeChild(tasks_to_do.firstChild);

    }
    to_do.getTasks().forEach(e => {
        const div = document.createElement('div');
        div.setAttribute('class', 'task');
        div.innerHTML = `<a>${e.getValue()}</a><button class="done">będę</button>`
        tasks_to_do.appendChild(div);
        i++
        div.querySelector('button').addEventListener('click', remove_task)
    });
    while (tasks_done.firstChild) {
        tasks_done.removeChild(tasks_done.firstChild);
    }
    done.getTasks().forEach(e => {
        const div = document.createElement('div');
        div.setAttribute('class', 'task');
        div.innerHTML = `${e.getValue()}`
        tasks_done.appendChild(div);

    });

}

function addNewTask() {
    const value = new_task.value;
    to_do.add_new_task(value, "+");
    to_doJ.push(new_task.value);
    console.log(to_doJ)
    display()
}
button.addEventListener('click', addNewTask)
search_val.addEventListener('input', search)