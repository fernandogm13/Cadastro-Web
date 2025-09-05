const tableBody = document.querySelector("#user-table tbody");
const searchInput = document.querySelector("#search");

function fetchUsers(query = "") {
  fetch(`../php/view_data.php?search=${encodeURIComponent(query)}`)
    .then((response) => response.json())
    .then((data) => {
      console.log(data); // Add this to inspect the data
      tableBody.innerHTML = "";
      if (data.length === 0) {
        tableBody.innerHTML =
          '<tr><td colspan="7">Nenhum usuário encontrado</td></tr>';
        return;
      }
      data.forEach((user) => {
        console.log(user); // Log each user object
        const row = document.createElement("tr");
        row.innerHTML = `
        <td>${user.id}</td>
        <td>${user.nome}</td>
        <td>${user.idade}</td>
        <td>${user.email}</td>
        <td>${user.cidade}</td>
        <td>${user.estado}</td>
        <td>
          <a href="../php/edit.php?id=${user.id}" class="user-action edit">Editar</a>
          <a href="../php/delete.php?id=${user.id}" class="user-action delete" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
        </td>
      `;
        tableBody.appendChild(row);
      });
    });
}

searchInput.addEventListener("input", () => {
  fetchUsers(searchInput.value);
});

fetchUsers();
