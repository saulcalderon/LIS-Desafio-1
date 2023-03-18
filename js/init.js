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
    if (window.location.pathname === '/transactions.html') {
      const user = JSON.parse(localStorage.getItem('user'));
      const transactions = user.transactions;

      // Bar chart for different types of services
      let sumaDineroServiciosDeAgua = 0;
      let sumaDineroServiciosDeLuz = 0;
      let sumaDineroServiciosDeInternet = 0;

      // Collecting data for the bar chart
      transactions.forEach((transaction) => {
        if (transaction.type === 'service') {
          if (transaction.category === 'agua') {
            sumaDineroServiciosDeAgua += transaction.amount;
          }

          if (transaction.category === 'luz') {
            sumaDineroServiciosDeLuz += transaction.amount;
          }

          if (transaction.category === 'internet') {
            sumaDineroServiciosDeInternet += transaction.amount;
          }
        }
      });

      // Creating the bar chart
      const ctx = document.getElementById('myChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            'Servicio de Luz',
            'Servicio de Agua',
            'Servicio de Internet',
          ],
          datasets: [
            {
              label: 'Total de gastos en servicios',
              data: [
                sumaDineroServiciosDeLuz,
                sumaDineroServiciosDeAgua,
                sumaDineroServiciosDeInternet,
              ],
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
              ],
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });

      // Pie chart for different transaction types
      let sumaDineroDepositos = 0;
      let sumaDineroRetiros = 0;
      let sumaDineroServicios = 0;

      // Collecting data for the pie chart
      transactions.forEach((transaction) => {
        if (transaction.type === 'deposit') {
          sumaDineroDepositos += transaction.amount;
        }

        if (transaction.type === 'withdraw') {
          sumaDineroRetiros += transaction.amount;
        }

        if (transaction.type === 'service') {
          sumaDineroServicios += transaction.amount;
        }
      });

      // Creating the pie chart
      const ctx2 = document.getElementById('myChart2').getContext('2d');
      new Chart(ctx2, {
        type: 'pie',
        data: {
          labels: ['Depósitos', 'Retiros', 'Servicios'],
          datasets: [
            {
              label: 'Total de transacciones en USD',
              data: [
                sumaDineroDepositos,
                sumaDineroRetiros,
                sumaDineroServicios,
              ],
              backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
              ],
              hoverOffset: 4,
            },
          ],
        },
      });

      // Creating the table with the transactions
      orderAndPrintTransactions(transactions);
    }
  }); // end of document ready

  $('#money-input').on('input', function () {
    // Get the current value of the input field
    var value = $(this).val();

    // Remove any non-numeric characters except the minus sign and dot
    value = value.replace(/[^0-9\-\.]|(?<=\..*)\./g, '');

    // Replace any double dots with a single dot
    value = value.replace(/(\..*)\./g, '$1');

    // Remove any dots before the first digit
    value = value.replace(/^\./g, '');

    // Allow only one minus sign at the beginning of the input
    if (
      value.indexOf('-') > 0 ||
      (value.indexOf('-') == 0 && !/^\-?[0-9]*\.?[0-9]*$/.test(value))
    ) {
      value = value.replace('-', '');
    }
    value = value.replace(/^(\-?)[^0-9]*$/, '$1');

    // Remove the minus sign if the input value is positive
    if (parseFloat(value) >= 0) {
      value = value.replace('-', '');
    }

    // Limit the integer part to 10 digits
    var parts = value.split('.');
    if (parts[0].length > 10) {
      parts[0] = parts[0].substring(0, 10);
      value = parts.join('.');
    }

    // Limit the decimal part to two digits
    if (parts.length > 1) {
      parts[1] = parts[1].substring(0, 2);
      value = parts.join('.');
    }

    // Update the input field with the sanitized value
    $(this).val(value);
  });

  // Funcion para imprimir transacciones de deposito
  function orderAndPrintTransactions(transactions) {
    const reverseTransactions = transactions.reverse();

    reverseTransactions.forEach((transaction) => {
      if (transaction.type === 'deposit') {
        printDepositTransaction(transaction.date, transaction.amount);
      }

      if (transaction.type === 'withdraw') {
        printWithdrawTransaction(transaction.date, transaction.amount);
      }

      if (transaction.type === 'service') {
        printServiceTransaction(
          transaction.category,
          transaction.date,
          transaction.amount
        );
      }
    });
  }
  // Function to get date in a readable format
  function getDateHoursAndMinutes(dateString) {
    const date = new Date(dateString);
    let pm = date.getHours() >= 12;
    let hour12 = date.getHours() % 12;
    if (!hour12) hour12 += 12;
    let minute = date.getMinutes();

    return (
      date.toISOString().split('T')[0] +
      ' - ' +
      `${hour12}:${minute} ${pm ? 'pm' : 'am'}`
    );
  }
  // Funcion para imprimir transacciones de deposito
  function printDepositTransaction(date, amount) {
    $('#transactions').append(`<li class="collection-item avatar">
           <i class="material-icons circle green">add</i>
           <span class="title black-text">Depósito | ${getDateHoursAndMinutes(
             date
           )} | $${amount}</span>
         </li>`);
  }
  // Funcion para imprimir transacciones de retiro
  function printWithdrawTransaction(date, amount) {
    $('#transactions').append(`<li class="collection-item avatar">
           <i class="material-icons circle red">remove</i>
           <span class="title black-text">Retiro | ${getDateHoursAndMinutes(
             date
           )} | $${amount}</span>
         </li>`);
  }
  // Funcion para imprimir transacciones de servicio
  function printServiceTransaction(category, date, amount) {
    $('#transactions').append(`<li class="collection-item avatar">
           <i class="material-icons circle red">remove</i>
           <span class="title black-text">Pago de servicio de ${category} | ${getDateHoursAndMinutes(
      date
    )} | $${amount}</span>
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

  // Logic for the income button
  $('#btn-income').click(function () {
    let depositMoneyInput = $('#money-input').val();
    let typeInput = $('#type').val();
    let selectTypeInput = $('#select-type').val();
    let datePickerInput = $('#transaction-date').val();

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

    const data = {
      amount: depositMoneyInput,
      type: typeInput,
      transactionType: selectTypeInput,
      date: datePickerInput,
    };

    console.log(data);

    $.ajax({
      type: 'POST',
      url: 'controllers/transaction.php',
      data,
      success: function (response) {
        // Handle the response
        console.log(response);

        swal(
          'Entrada guardada exitosamente',
          `La entrada por la cantidad de $${depositMoneyInput} fue exitosa.`,
          'success'
        ).then(() => {
          window.location.href = '/LIS-Desafio-1/menu.php';
        });
        return;
      },
      error: function (xhr, status, error) {
        // Handle the error response
        swal(
          'Error al guardar la entrada',
          'Por favor inténtelo de nuevo.',
          'error'
        );
        console.log(error);
        console.log(status);
        console.log(xhr);
      },
    });
  });

  // Logic for the withdraw button in withdraw.html
  $('#btn-withdraw').click(function () {
    let withdrawMoneyInput = $('#withdraw-money-input').val();
    if (!withdrawMoneyInput) {
      swal(
        'Campo vacío',
        'El campo del monto a retirar esta vacío, por favor inténtelo de nuevo.',
        'warning'
      );
      return;
    }

    withdrawMoneyInput = parseFloat(withdrawMoneyInput).toFixed(2);

    // Getting the user from local storage
    const user = JSON.parse(localStorage.getItem('user'));
    // Updating the user balance and saving it
    const newBalance =
      parseFloat(user.balance) - parseFloat(withdrawMoneyInput);
    if (newBalance < 0) {
      swal(
        'Saldo insuficiente',
        'No tiene suficiente saldo para realizar esta operación.',
        'error'
      );
      return;
    }

    user.balance = newBalance;
    const transactionDate = new Date();
    user.transactions.push({
      type: 'withdraw',
      amount: parseFloat(withdrawMoneyInput),
      date: transactionDate,
    });
    localStorage.setItem('user', JSON.stringify(user));

    swal(
      'Retiro exitoso',
      `El retiro por la cantidad de $${withdrawMoneyInput} fue exitoso.`,
      'success'
    ).then(() => {
      generateWithdrawPDF(
        user,
        withdrawMoneyInput,
        newBalance,
        transactionDate
      );
      window.location.href = 'menu.html';
    });
  });

  // Logic for services buttons
  $('.btn-services').click(function (event) {
    swal('Digite el número único de la factura a pagar:', {
      closeOnClickOutside: false,
      content: {
        element: 'input',
        attributes: {
          placeholder: 'Número de factura',
          type: 'number',
        },
      },
      buttons: {
        cancel: 'Cancelar',
        confirm: 'Siguiente',
      },
    }).then((noBill) => {
      // Validaciones para el numero de factura
      if (
        isNaN(noBill) ||
        noBill.includes('e') ||
        noBill.includes('E') ||
        noBill.includes('-') ||
        noBill.includes('.') ||
        noBill === '0'
      ) {
        swal(
          'Valor inválido',
          'El número de factura debe ser un número, por favor inténtelo de nuevo.',
          'error'
        );
        return;
      }

      // Modal para ingresar el monto a pagar de la factura
      swal('Digite la cantidad a pagar en USD', {
        closeOnClickOutside: false,
        content: {
          element: 'input',
          attributes: {
            placeholder: 'Monto a pagar',
            type: 'number',
          },
        },
        buttons: {
          cancel: 'Cancelar',
          confirm: 'Confirmar',
        },
      }).then((value) => {
        // Validaciones para el monto a pagar
        if (
          isNaN(value) ||
          value.includes('e') ||
          value.includes('E') ||
          value.includes('-') ||
          value < 0.01
        ) {
          swal(
            'Valor inválido',
            'El valor del monto de la factura es inválido, por favor inténtelo de nuevo.',
            'error'
          );
          return;
        }

        value = parseFloat(value).toFixed(2);

        // Getting the user from local storage
        const user = JSON.parse(localStorage.getItem('user'));
        // Updating the user balance
        const newBalance = parseFloat(user.balance) - parseFloat(value);
        if (newBalance < 0) {
          swal(
            'Saldo insuficiente',
            'No tiene suficiente saldo para realizar esta operación.',
            'error'
          );
          return;
        }

        // Saving the transaction
        user.balance = newBalance;
        const transactionDate = new Date();
        user.transactions.push({
          type: 'service',
          category: event.target.id,
          noBill,
          amount: parseFloat(value),
          date: transactionDate,
        });
        localStorage.setItem('user', JSON.stringify(user));

        swal(
          'Pago exitoso',
          `El pago por la cantidad de $${value} fue exitoso.`,
          'success'
        ).then(() => {
          generateServicePDF(
            user,
            event.target.id,
            noBill,
            value,
            newBalance,
            transactionDate
          );
          window.location.href = 'menu.html';
        });
      });
    });
  });

  // Logic for adding all transactions to the table in transactions.html
  $('#transaction-all').click(function () {
    const user = JSON.parse(localStorage.getItem('user'));
    const transactions = user.transactions;

    // Clearing the table
    $('#transactions').empty();

    // Adding the transactions to the table
    orderAndPrintTransactions(transactions);
  });

  // Logic for adding only income transactions to the table in transactions.html
  $('#transaction-income').click(function () {
    const user = JSON.parse(localStorage.getItem('user'));
    const transactions = user.transactions;

    // Clearing the table
    $('#transactions').empty();

    // Adding the transactions to the table
    const incomeTransactions = transactions.filter(
      (transaction) => transaction.type === 'deposit'
    );
    orderAndPrintTransactions(incomeTransactions);
  });

  // Logic for adding only expenses transactions to the table in transactions.html
  $('#transaction-expense').click(function () {
    const user = JSON.parse(localStorage.getItem('user'));
    const transactions = user.transactions;

    // Clearing the table
    $('#transactions').empty();

    // Adding the transactions to the table
    const expenseTransactions = transactions.filter(
      (transaction) =>
        transaction.type === 'withdraw' || transaction.type === 'service'
    );
    orderAndPrintTransactions(expenseTransactions);
  });

  // Generate PDF for transactions
  function generateDepositPDF(
    user,
    depositMoneyInput,
    newBalance,
    transactionDate
  ) {
    const doc = new jsPDF();
    doc.setFontSize(36);
    doc.setFontStyle('bold');
    doc.text('Pokemon Bank', 55, 30, { align: 'center' });

    doc.setFontSize(18);
    doc.setFontStyle('normal');
    doc.text('Depósito exitoso', 65, 50, { align: 'center' });
    doc.text(`Nombre: ${user.name}`, 65, 70, {
      align: 'center',
    });
    doc.text(`Número de cuenta: ${user.noAccount}`, 65, 80, {
      align: 'center',
    });
    doc.text(`Cantidad depósitada: $${depositMoneyInput}`, 65, 100, {
      align: 'center',
    });
    doc.text(`Nuevo balance: $${newBalance}`, 65, 110, {
      align: 'center',
    });
    doc.text(
      `Fecha y hora: ${getDateHoursAndMinutes(transactionDate.toISOString())}`,
      65,
      120,
      {
        align: 'center',
      }
    );

    doc.save(`PB - Deposito - ${new Date().toISOString().split('T')[0]}.pdf`);
  }

  function generateWithdrawPDF(
    user,
    withdrawMoneyInput,
    newBalance,
    transactionDate
  ) {
    const doc = new jsPDF();
    doc.setFontSize(36);
    doc.setFontStyle('bold');
    doc.text('Pokemon Bank', 55, 30, { align: 'center' });

    doc.setFontSize(18);
    doc.setFontStyle('normal');
    doc.text('Retiro exitoso', 65, 50, { align: 'center' });
    doc.text(`Nombre: ${user.name}`, 65, 70, {
      align: 'center',
    });
    doc.text(`Número de cuenta: ${user.noAccount}`, 65, 80, {
      align: 'center',
    });
    doc.text(`Cantidad retirada: $${withdrawMoneyInput}`, 65, 100, {
      align: 'center',
    });
    doc.text(`Nuevo balance: $${newBalance}`, 65, 110, {
      align: 'center',
    });
    doc.text(
      `Fecha y hora: ${getDateHoursAndMinutes(transactionDate.toISOString())}`,
      65,
      120,
      {
        align: 'center',
      }
    );

    doc.save(`PB - Retiro - ${new Date().toISOString().split('T')[0]}.pdf`);
  }

  function generateServicePDF(
    user,
    category,
    noBill,
    amount,
    newBalance,
    transactionDate
  ) {
    const doc = new jsPDF();
    doc.setFontSize(36);
    doc.setFontStyle('bold');
    doc.text('Pokemon Bank', 55, 30, { align: 'center' });

    doc.setFontSize(18);
    doc.setFontStyle('normal');
    doc.text('Pago de servicio exitoso', 65, 50, { align: 'center' });
    doc.text(`Nombre: ${user.name}`, 65, 70, {
      align: 'center',
    });
    doc.text(`Número de cuenta: ${user.noAccount}`, 65, 80, {
      align: 'center',
    });
    doc.text(`Categoría de servicio a pagar: ${category}`, 65, 100, {
      align: 'center',
    });
    doc.text(`Número de factura: ${noBill}`, 65, 110, {
      align: 'center',
    });
    doc.text(`Cargo: $${amount}`, 65, 120, {
      align: 'center',
    });
    doc.text(`Nuevo balance: $${newBalance}`, 65, 130, {
      align: 'center',
    });
    doc.text(
      `Fecha y hora: ${getDateHoursAndMinutes(transactionDate.toISOString())}`,
      65,
      140,
      {
        align: 'center',
      }
    );

    doc.save(
      `PB - Pago servicio - ${new Date().toISOString().split('T')[0]}.pdf`
    );
  }
})(jQuery); // end of jQuery name space
