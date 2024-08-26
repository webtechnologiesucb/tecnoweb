class Calculator {
  /**
   * Cargamos el objeto calculadora con sus parametros base
   */
  constructor(operand1Element, operand2Element) {
    this.operand1Element = operand1Element;
    this.operand2Element = operand2Element;
    this.clear();
  }

  /**
   * limpieza de pantalla inicial
   */
  clear() {
    this.operand1 = 0;
    this.operand2 = 0;
    this.operator = "";
    this.updateUI();
  }

  /**
   * actualizar los controles del html
   */
  updateUI() {
    this.operand1Element.innerHTML = this.operand1 + this.operator;
    this.operand2Element.innerHTML = this.operand2;
  }

  /**
   * agregar numeros y punto decimal
   * @param {*} number numero o punto decimal agregado
   * @returns
   */
  appendNumber(number) {
    if (number === "." && this.operand2.includes(".")) return;
    this.operand2 =
      this.operand2 === 0 ? number : this.operand2.toString() + number;
    this.updateUI();
  }

  /**
   * borrar numero a numero
   * @returns valor vacio si uno usa mas puntos decimales
   */
  delete() {
    if (this.operand2 === 0) return;
    this.operand2 = +this.operand2.toString().slice(0, -1);
    this.updateUI();
  }

  /**
   * invoca a los operadores
   * @param {*} operator operador ingresado por el usuario
   */
  operation(operator) {
    if (this.operator) {
      this.calc();
    }
    this.operator = operator;
    this.operand1 = +this.operand2 === 0 ? this.operand1 : this.operand2;
    this.operand2 = 0;
    this.updateUI();
  }

  /**
   * realiza los calculos sobre el operador enviado
   */
  calc() {
    switch (this.operator) {
      case "+":
        this.operand1 = +this.operand1 + +this.operand2;
        break;
      case "-":
        this.operand1 = +this.operand1 - +this.operand2;
        break;
      case "*":
        this.operand1 = +this.operand1 * +this.operand2;
        break;
      case "/":
        this.operand1 = +this.operand1 / +this.operand2;
        break;
    }
    this.operator = "";
    this.operand2 = 0;
    this.updateUI();
  }
}

// constantes para los botones usando querySelector y querySelectorAll
const operand1Element = document.querySelector("[data-operand-1]");
const operand2Element = document.querySelector("[data-operand-2]");
const clearButton = document.querySelector("[data-clear]");
const numberButtons = document.querySelectorAll("[data-number]");
const deleteButton = document.querySelector("[data-delete]");
const operationButton = document.querySelectorAll("[data-operation]");
const equalsButton = document.querySelector("[data-equals]");

// generacion del objeto
const calculator = new Calculator(operand1Element, operand2Element);

/**
 * evento para limpiar la pantalla
 */
clearButton.addEventListener("click", () => {
  calculator.clear();
});

/**
 * evento de colocar numeros en la pantalla
 */
numberButtons.forEach((button) => {
  button.addEventListener("click", () => {
    calculator.appendNumber(button.innerHTML);
  });
});

/**
 * evento de borrado de digitos o punto decimal
 */
deleteButton.addEventListener("click", () => {
  calculator.delete();
});

/**
 * evento de uso de los operadores
 */
operationButton.forEach((button) => {
  button.addEventListener("click", () => {
    calculator.operation(button.innerHTML);
  });
});

/**
 * evento de uso del boton igual
 */
equalsButton.addEventListener("click", () => {
  calculator.calc();
});
