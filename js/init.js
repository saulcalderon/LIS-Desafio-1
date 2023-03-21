(function ($) {
  $(function () {
    $('.sidenav').sidenav();
    $('.parallax').parallax();
    $('select').formSelect();
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
    });

    // Impresion de los datos del usuario en el DOM
    if (localStorage.getItem('user')) {
      const user = JSON.parse(localStorage.getItem('user'));
      $('.bienvenida').text(`Bienvenido/a ${user.firstName} ${user.lastName}`);
    }

    // Custom logic for transactions page
    if (window.location.pathname === '/LIS-Desafio-1/ver-entradas.php') {
      getIncomeTransactions().catch(() => {
        swal(
          'No se encontraron transacciones de entrada',
          'Por favor inténtelo de nuevo.',
          'error'
        ).then(() => {
          window.location.href = '/LIS-Desafio-1/menu.php';
        });
      });
    }

    if (window.location.pathname === '/LIS-Desafio-1/ver-salidas.php') {
      getOutcomeTransactions().catch(() => {
        swal(
          'No se encontraron transacciones de salida',
          'Por favor inténtelo de nuevo.',
          'error'
        ).then(() => {
          window.location.href = '/LIS-Desafio-1/menu.php';
        });
      });
    }

    if (window.location.pathname === '/LIS-Desafio-1/transactions.php') {
      let sumaIngresos = 0;
      let sumaEgresos = 0;

      getIncomeTransactions()
        .then((transactions) => {
          console.log('transactions promise', transactions);
          transactions.forEach((transaction) => {
            const transformedAmount = parseFloat(transaction.amount);
            sumaIngresos += transformedAmount;
          });

          console.log('sumaIngresos', sumaIngresos);
          // set the sum of incomes in the DOM
          $('.income-title').text('Ingresos: $' + sumaIngresos);

          getOutcomeTransactions()
            .then((transactions) => {
              console.log('transactions promise', transactions);
              transactions.forEach((transaction) => {
                const transformedAmount = parseFloat(transaction.amount);
                sumaEgresos += transformedAmount;
              });

              console.log('sumaEgresos', sumaEgresos);
              $('.outcome-title').text('Egresos: $' + sumaEgresos);

              const balance = sumaIngresos + sumaEgresos;
              console.log('balance', balance);

              printPieChart(sumaIngresos, sumaEgresos);
            })
            .catch(() => {
              swal(
                'No se encontraron transacciones de salida',
                'Por favor inténtelo de nuevo.',
                'error'
              ).then(() => {
                printPieChart(sumaIngresos, sumaEgresos);
              });
            });
        })
        .catch(() => {
          swal(
            'No se encontraron transacciones de entrada',
            'Por favor inténtelo de nuevo.',
            'error'
          ).then(() => {
            printPieChart(sumaIngresos, sumaEgresos);
          });
        });
    }
  }); // end of document ready

  $('#money-input').on('input', function () {
    // Get the current value of the input field
    let value = $(this).val();

    // Determine if we're on the "income" or "outcome" page
    const isIncomePage =
      window.location.pathname === '/LIS-Desafio-1/registrar-entradas.php';

    // Remove any non-numeric characters except the dot
    value = value.replace(/[^0-9\.]|(?<=\..*)\./g, '');

    // Replace any double dots with a single dot
    value = value.replace(/(\..*)\./g, '$1');

    // Remove any dots before the first digit
    value = value.replace(/^\./g, '');

    // Limit the integer part to 10 digits
    let parts = value.split('.');
    if (parts[0].length > 10) {
      parts[0] = parts[0].substring(0, 10);
      value = parts.join('.');
    }

    // Limit the decimal part to two digits
    if (parts.length > 1) {
      parts[1] = parts[1].substring(0, 2);
      value = parts.join('.');
    }

    // Add or remove the minus sign depending on the page
    if (!isIncomePage) {
      if (value.charAt(0) !== '-') {
        value = '-' + value;
      }
    } else {
      value = value.replace('-', '');
    }

    // Update the input field with the sanitized value
    $(this).val(value);
  });

  function printPieChart(income, outcome) {
    // Creating the pie chart
    const ctx = document.getElementById('pie-chart').getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Ingresos', 'Egresos'],
        datasets: [
          {
            label: 'Resumen mensual de transacciones',
            data: [income, outcome],
            backgroundColor: ['rgb(75, 192, 192)', 'rgb(255, 99, 132)'],
            hoverOffset: 4,
          },
        ],
      },
    });
  }

  function getIncomeTransactions() {
    // Get the transactions from the database
    return new Promise((resolve, reject) => {
      const transactions = [];
      $.ajax({
        url: 'controllers/transaction.php?type=income',
        type: 'GET',
        success: function (response) {
          // console.log(response);
          for (const transaction of response) {
            transactions.push(transaction);
            printIncomeTransaction(
              transaction.type,
              transaction.date,
              transaction.amount
            );
          }
          resolve(transactions);
        },
        error: function (error) {
          console.log(error);
          reject(error);
        },
      });
    });
  }

  function getOutcomeTransactions() {
    // Get the transactions from the database
    return new Promise((resolve, reject) => {
      const transactions = [];
      $.ajax({
        url: 'controllers/transaction.php?type=outcome',
        type: 'GET',
        success: function (response) {
          // console.log(response);
          for (const transaction of response) {
            transactions.push(transaction);
            printOutcomeTransaction(
              transaction.type,
              transaction.date,
              transaction.amount
            );
          }
          resolve(transactions);
        },
        error: function (error) {
          console.log(error);
          reject(error);
        },
      });
    });
  }

  // Funcion para imprimir transacciones de entrada
  function printIncomeTransaction(type, date, amount) {
    $('#transactions-income').append(`<li class="collection-item avatar">
           <i class="material-icons circle green">add</i>
           <span class="title black-text" style="word-spacing:1em;">${type}  |  ${date}  |  $${amount}</span>
         </li>`);
  }

  // Funcion para imprimir transacciones de salida
  function printOutcomeTransaction(type, date, amount) {
    $('#transactions-outcome').append(`<li class="collection-item avatar">
           <i class="material-icons circle red">remove</i>
           <span class="title black-text" style="word-spacing:1em;">${type}  |  ${date}  |  $${amount}</span>
         </li>`);
  }

  // Logic for the login page
  $('#btn-login').click(function () {
    const userValue = $('#user-input').val();
    const pinValue = $('#pin').val();

    if (!userValue || !pinValue) {
      swal(
        'Campos de entrada vacíos',
        'Uno o más campos están vacíos, por favor inténtelo de nuevo.',
        'warning'
      );
      return;
    }

    $.ajax({
      type: 'POST',
      url: 'controllers/login.php',
      data: {
        username: userValue.trim(),
        pin: pinValue.trim(),
      },
      success: function (response) {
        // Handle the response
        console.log(response);

        // Save the user in local storage
        localStorage.setItem('user', JSON.stringify(response));

        swal('Bienvenido', '', 'success').then(() => {
          window.location.href = '/LIS-Desafio-1/menu.php';
        });
        return;
      },
      error: function (xhr, status, error) {
        // Handle the error response
        swal(
          'Usuario o PIN incorrecto',
          'Por favor inténtelo de nuevo.',
          'error'
        );
        console.log(error);
        console.log(status);
        console.log(xhr);
      },
    });
  });

  // Logic for logout button
  $('.logout').click(function (event) {
    event.preventDefault();

    $.ajax({
      type: 'POST',
      url: 'controllers/logout.php',
      success: function (response) {
        // Handle the response
        console.log(response);
        swal('Hasta Luego', '', 'success').then(() => {
          window.location.href = '/LIS-Desafio-1/index.php';
        });
        return;
      },
    });
  });

  // Logic for the transaction button
  $('#btn-transaction').click(function (event) {
    event.preventDefault();

    let depositMoneyInput = $('#money-input').val();
    let typeInput = $('#type').val();
    let selectTypeInput = $('#select-type').val();
    let datePickerInput = $('#transaction-date').val();
    let fileData = $('#photo-input').prop('files')[0];

    // Validate the input values
    if (
      !depositMoneyInput ||
      !typeInput ||
      !selectTypeInput ||
      !datePickerInput
    ) {
      swal(
        'Campos de entrada vacíos',
        'Uno o más campos están vacíos, por favor inténtelo de nuevo.',
        'warning'
      );
      return;
    }

    depositMoneyInput = parseFloat(depositMoneyInput);

    const formData = new FormData();
    formData.append('amount', depositMoneyInput);
    formData.append('type', typeInput);
    formData.append('transactionType', selectTypeInput);
    formData.append('date', datePickerInput);

    if (fileData) {
      formData.append('photo', fileData);
    }

    for (const value of formData.values()) {
      console.log(value);
    }

    console.log(formData);

    let pageLocationMessage = null;
    const isIncomePage =
      window.location.pathname === '/LIS-Desafio-1/registrar-entradas.php';

    if (isIncomePage) {
      pageLocationMessage = 'Entrada';
    } else {
      pageLocationMessage = 'Salida';
    }

    $.ajax({
      type: 'POST',
      url: 'controllers/transaction.php',
      processData: false,
      contentType: false,
      cache: false,
      data: formData,
      enctype: 'multipart/form-data',
      success: function (response) {
        // Handle the response
        console.log(response);
        swal(
          `${pageLocationMessage} guardada exitosamente`,
          `La ${pageLocationMessage} por la cantidad de $${depositMoneyInput} fue exitosa.`,
          'success'
        ).then(() => {
          window.location.href = '/LIS-Desafio-1/menu.php';
        });
        return;
      },
      error: function (xhr, status, error) {
        // Handle the error response
        swal(
          `Error al guardar la ${pageLocationMessage}`,
          'Por favor inténtelo de nuevo.',
          'error'
        );
        console.log(error);
        console.log(status);
        console.log(xhr);
      },
    });
  });
})(jQuery); // end of jQuery name space
