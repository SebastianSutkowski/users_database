class Tasks {
    constructor() {
        const taskK = new Task("zadanie", "+")
        let _value = task.getValue();
        let _purpose = task.getPurpose();
        this.tasks = []
        this.getTasks = () => this.tasks;
    }
    add_new_task(zad, purp) {
        const taskK = new Task(zad, purp)
        this.tasks.push(taskK)
    }
    remove_task(index) {
        this.tasks.splice(index, 1)

    }
}