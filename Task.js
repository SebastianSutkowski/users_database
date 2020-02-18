class Task {
    constructor(value, purpose) {
        let _value = value;
        let _purpose = purpose;
        this.getValue = () => _value;
        this.getPurpose = () => _purpose;
    }

}
const task = new Task("zadanie", "+")