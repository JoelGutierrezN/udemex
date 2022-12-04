let Cosmic = {
    table: ({
        container,
        url,
        method,
        headers,
        tableElements,
        classes,
        paginate,
        exportable,
    }) => {
        let containers = {
            table: document.createElement("table"),
            tableContainer: document.querySelector(container),
            tableHeader: document.createElement("thead"),
            tableBody: document.createElement("tbody"),
            tableFooter: document.createElement("tfoot"),
            paginateRow: document.createElement("tr"),
            paginateColumn: document.createElement("th"),
            paginateSelect: document.createElement("select"),
        };
        let functions = {
            createTable: () => {
                classes.forEach((element) => {
                    containers.table.className += element + " ";
                });
                containers.tableContainer.appendChild(containers.table);
                containers.table.appendChild(containers.tableHeader);
                containers.table.appendChild(containers.tableBody);
                containers.table.appendChild(containers.tableFooter);

                containers.table.setAttribute("id", "cosmic-table");
                containers.tableHeader.setAttribute(
                    "id",
                    "cosmic-table-header"
                );
                containers.tableBody.setAttribute("id", "cosmic-table-body");
                containers.tableFooter.setAttribute(
                    "id",
                    "cosmic-table-footer"
                );
            },
            appendingHeader: () => {
                let count = 0;
                let tableHeaderRow = document.createElement("tr");
                tableElements.forEach((element) => {
                    let column = document.createElement("th");
                    column.innerHTML = element.name.toUpperCase();
                    column.setAttribute(
                        "id",
                        `cosmic-header-${element.name[count]}`
                    );
                    tableHeaderRow.appendChild(column);

                    count = count == tableElements.length ? 0 : count + 1;
                });
                containers.tableHeader.appendChild(tableHeaderRow);
            },
            appendingFilters: (results) => {
                let tableFilterRow = document.createElement("tr");
                tableElements.forEach((element) => {
                    let filterColumn = document.createElement("td");
                    let filter = element.filter
                        ? document.createElement("input")
                        : document.createElement("span");
                    if (element.filter) {
                        filter.setAttribute(
                            "id",
                            `cosmic-filter-${element.name}`
                        );
                        filter.className = "form-control";

                        filter.addEventListener("keyup", (e) => {
                            let newElements = results.filter((el) => {
                                return el[element.column]
                                    .toLowerCase()
                                    .indexOf(filter.value.toLowerCase()) >= 0
                                    ? element
                                    : "";
                            });

                            containers.tableBody.innerHTML = "";
                            functions.appendingPaginatedRows(1, newElements);
                        });
                    }
                    filterColumn.appendChild(filter);
                    tableFilterRow.appendChild(filterColumn);
                });
                containers.tableHeader.appendChild(tableFilterRow);
            },
            appendingRows: (results) => {
                results.forEach((element) => {
                    let tableRow = document.createElement("tr");
                    containers.tableBody.appendChild(tableRow);
                    functions.appendingColumns({
                        element: element,
                        row: tableRow,
                    });
                });
            },
            createPaginateSelect: () => {
                containers.paginateColumn.setAttribute(
                    "colspan",
                    tableElements.length
                );
                containers.paginateColumn.setAttribute(
                    "style",
                    "text-align: center;"
                );
                containers.paginateRow.appendChild(containers.paginateColumn);

                containers.paginateColumn.innerHTML = "Pagina: ";
                containers.paginateColumn.appendChild(
                    containers.paginateSelect
                );
            },
            appendingPaginatedRows: (paginateOption, results) => {
                if (paginateOption <= results.length) {
                    for (
                        var index = paginate * paginateOption - paginate;
                        index < paginate * paginateOption;
                        index++
                    ) {
                        let tableRow = document.createElement("tr");
                        containers.tableBody.appendChild(tableRow);
                        functions.appendingColumns({
                            results: results,
                            row: tableRow,
                            index: index,
                        });
                    }
                }
            },
            appendingColumns: ({
                results = null,
                element = null,
                row,
                index = null,
            }) => {
                let count = 0;
                tableElements.forEach((el) => {
                    let column = document.createElement("td");
                    if (el.format != null) {
                        column.innerHTML =
                            index == null
                                ? el.format(element[el.column])
                                : el.format(results[index][el.column]);
                    } else {
                        column.innerHTML =
                            index == null
                                ? el.column
                                : results[index][el.column];
                    }
                    column.setAttribute(
                        "id",
                        `cosmic-column-${el.name[count]}`
                    );
                    row.appendChild(column);
                    count = count == tableElements.length ? 0 : count + 1;
                });
            },
            exportData: (result) => {
                // TODO: terminar la funcion para exportar
            },
            execute: () => {
                functions.createTable();
                functions.appendingHeader();
                fetch(
                    url,
                    method == "POST"
                        ? {
                              method: method,
                              body: params,
                              headers: headers,
                          }
                        : {
                              method: method,
                          }
                )
                    .then((response) => response.json())
                    .then((data) => {
                        let results = data;
                        if (
                            paginate == null ||
                            paginate <= 0 ||
                            paginate == ""
                        ) {
                            functions.appendingRows(results);
                        } else {
                            functions.createPaginateSelect();
                            functions.appendingFilters(results);
                            let count = results.length / paginate;
                            for (var i = 0; i < count; i++) {
                                let paginateOption =
                                    document.createElement("option");
                                paginateOption.value = i + 1;
                                paginateOption.innerText = i + 1;
                                containers.paginateSelect.appendChild(
                                    paginateOption
                                );

                                paginateOption.addEventListener("click", () => {
                                    containers.tableBody.innerHTML = "";
                                    functions.appendingPaginatedRows(
                                        paginateOption.value,
                                        results
                                    );
                                });
                            }
                            containers.tableFooter.appendChild(
                                containers.paginateRow
                            );
                            functions.appendingPaginatedRows(1, results);
                        }
                    });
            },
        };
        if (container == null || container == "") {
            console.warn("No se declaro contenedor para la tabla");
        }
        if (url == null || url == "") {
            console.warn("Sin url");
        } else {
            functions.execute();
        }
    },
};
