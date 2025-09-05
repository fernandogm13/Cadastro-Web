const normalizar = (texto) => texto.replace(/\s+/g, " ").trim();
//Nome
const nome = document.querySelector("#nome");
const nomeError = document.querySelector("#nome-error");

function validateNomeField() {
  const value = normalizar(nome.value);

  if (value.length === 0) {
    return "O nome é obrigatório.";
  }
  if (value.length > 100) {
    return "O nome é muito longo (máx. 100 caracteres).";
  }
  return ""; //Sem erro
}

nome.addEventListener("input", () => {
  const err = validateNomeField();
  if (err) {
    nomeError.textContent = err;
    nomeError.style.display = "block"; // mostra
  } else {
    nomeError.textContent = "";
    nomeError.style.display = "none"; // esconde
  }
});

//Idade
const idade = document.querySelector("#idade");
const idadeError = document.querySelector("#idade-error");

function validateIdadeField() {
  const value = idade.value;

  if (value === "") {
    return "A idade é obrigatória.";
  }

  const numero = Number(value);
  if (!Number.isInteger(numero)) {
    return "A idade deve ser um número inteiro.";
  }

  if (numero < 0) {
    return "A idade não pode ser negativa.";
  }

  if (numero > 100) {
    return "A idade deve ser no máximo 100.";
  }
  return "";
}

idade.addEventListener("input", () => {
  const err = validateIdadeField();
  if (err) {
    idadeError.textContent = err;
    idadeError.style.display = "block"; // mostra
  } else {
    idadeError.textContent = "";
    idadeError.style.display = "none"; // esconde
  }
});

//Email
const email = document.querySelector("#email");
const emailError = document.querySelector("#email-error");

function validateEmailField() {
  const value = normalizar(email.value);

  if (value.length === 0) {
    return "O email é obrigatório.";
  }

  if (value.length > 100) {
    return "O email é muito long (máx. 100 caracteres).";
  }

  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!emailRegex.test(value)) {
    return "Email inválido.";
  }
  return "";
}

email.addEventListener("input", () => {
  const err = validateEmailField();
  if (err) {
    emailError.textContent = err;
    emailError.style.display = "block";
  } else {
    emailError.textContent = "";
    emailError.style.display = "none";
  }
});

//Cidade
const cidade = document.querySelector("#cidade");
const cidadeError = document.querySelector("#cidade-error");

function validateCidadeField() {
  // trocar de validade para validate
  const value = normalizar(cidade.value);

  if (value.length === 0) {
    return "A cidade é obrigatória.";
  }

  if (value.length > 50) {
    return "A cidade é muito longa (máx. 50 caracteres).";
  }
  return "";
}

cidade.addEventListener("input", () => {
  const err = validateCidadeField();
  if (err) {
    cidadeError.textContent = err;
    cidadeError.style.display = "block";
  } else {
    cidadeError.textContent = "";
    cidadeError.style.display = "none";
  }
});

//Form Submit
const form = document.querySelector("form");

form.addEventListener("submit", (e) => {
  const nomeErr = validateNomeField();
  const idadeErr = validateIdadeField();
  const emailErr = validateEmailField();
  const cidadeErr = validateCidadeField();

  if (nomeErr || idadeErr || emailErr || cidadeErr) {
    e.preventDefault();
    alert([nomeErr, idadeErr, emailErr, cidadeErr].filter(Boolean).join("\n"));
  }
});

const params = new URLSearchParams(window.location.search);
if (params.get("success")) {
  alert("Cadastro realizado com sucesso!");
}