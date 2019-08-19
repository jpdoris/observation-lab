<template>
  <div class="data-table">
    <div class="row-details text-right">
      <span>Results per page: </span>
      <select class="form-control custom-select" v-model="currentLimit" @change="fetchRows()">
        <option v-for="option in limits" :value="option">{{ option }}</option>
      </select>
    </div>
    <div class="clearfix"></div>
    <table :data-source="src" class="table table-sm table-hover">
      <thead>
        <tr>
          <th v-for="(header, id) in schema"
            :data-column="id"
            :data-sort="header.sort"
            :class="(id == sortColumn) ? 'active' : ''"
            @click="changeSort(id)">

            <span v-if="header.sort" :class="getSortClasses(id)"></span>
            {{ header.label }}
          </th>
          <th v-if="actions" class="actions"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(row, rowIndex) in rows">
          <td v-for="(column, name) in schema" :data-column="name" v-html="getRowData(rowIndex, name)"></td>

          <td v-if="actions" data-column="actions" class="actions text-right">
            <a :href="getActionLink(row, 'edit')"><button class="btn btn-sm btn-info"><span class="fa fa-pencil"></span></button></a>
            <a :href="getActionLink(row, 'delete')"><button class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></button></a>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="result-details">
      <ul class="pagination justify-content-end">
        <li class="page-item" :class="{ disabled: currentPage == 1 }">
          <a class="page-link" @click="changePage(1)"><span class="fa fa-angle-double-left" :disabled="currentPage == 1"></span></a></li>
        <li class="page-item" :class="{ disabled: currentPage == 1 }">
          <a class="page-link" @click="changePage(currentPage - 1)"><span class="fa fa-angle-left"></span></a></li>
        <li class="page-item" :class="{ disabled: currentPage == lastPage }">
          <a class="page-link" @click="changePage(currentPage + 1)"><span class="fa fa-angle-right"></span></a></li>
        <li class="page-item" :class="{ disabled: currentPage == lastPage }">
          <a class="page-link" @click="changePage(lastPage)"><span class="fa fa-angle-double-right"></span></a></li>
      </ul>
      <div class="text-muted text-right">Showing #{{ fromRecord }} - {{ toRecord }} (of {{ total }})</div>
    </div>
  </div>
</template>

<script>
  export default {

    props: {

      /**
       * The URL of the table data source (JSON only).
       * @var string
       */
      'src': {},

      /**
       * The default limit option.
       * @var int
       */
      'limit': { default: 10 },

      /**
       * An array of integers for row limit options.
       * @var array
       */
      'limits': { default: function() {
        return [10, 25, 50, 100];
      }},

      /**
       * An array of table header labels.
       * @var array
       */
      'headers': { default: function() {
        return [];
      }},

      /**
       * An array of table column names for rows.
       * @var array
       */
      'columns': { default: function() {
        return [];
      }},

      /**
       * An array of JSON prop names to render in the data table.
       * @var array
       */
      'outputColumns': { default: function() {
        return [];
      }},

      /**
       * An array of table header sort values (true or false).
       * @var array
       */
      'sort': {},

      /**
       * The default sort column.
       * @var string
       */
      'sortBy': { default: '' },

      /**
       * The default sort direction.
       * @var string
       */
      'sortDir': { default: '' },

      /**
       * A flag to show/hide actions for rows.
       * @boolean
       */
      'actions': { default: true },
    },

    data: function() {
      return {

        /**
         * An object containing table headers/columns:
         * @var object
         */
        schema: {},

        /**
         * An array of table row objects.
         * @var array
         */
        rows: [],

        /**
         * A mutable property for the outputColumns prop.
         * @var array
         */
        renderColumns: [],

        /**
         * Current sort column.
         * @var string
         */
        sortColumn: '',

        /**
         * Current sort direction.
         * @var string ("asc" or "desc")
         */
        sortDirection: 'asc',

        /**
         * Current pagination page.
         * @var int
         */
        currentPage: 1,

        /**
         * Flag that determines current load state of the component.
         * @var boolean
         */
        isLoading: false,

        /**
         * Total rows (without pagination).
         * @var int
         */
        total: 0,

        /**
         * The last pagination page.
         * @var int
         */
        lastPage: 1,

        /**
         * The count of the first record shown.
         * @var int
         */
        fromRecord: 0,

        /**
         * The count of the last record shown.
         * @var int
         */
        toRecord: 0,

        /**
         * An array of pagination link pages.
         * @var array
         */
        pages: [],

        /**
         * Currently selected limit option.
         * @var int
         */
        currentLimit: 10,
      };
    },

    /**
     * Check props and build table from AJAX source on load.
     */
    created: function() {
      this.renderColumns = (this.outputColumns.length) ? this.outputColumns : this.columns;

      if (this.propsAreValid()) {
        this.buildSchema();
        this.fetchRows();
      }
    },

    methods: {

      /**
       * Validate the data-table props before parsing.
       * @return void
       */
      propsAreValid: function() {
        if (!this.columns && !this.headers) {
          console.error('DataTable: columns and headers props are required.');
          return false;
        }

        if (this.columns.length !== this.headers.length) {
          console.error('DataTable: columns and headers props must have the same number of elements.');
          return false;
        }

        if (this.columns.length !== this.renderColumns.length) {
          console.log(this.columns, this.renderColumns);
          console.error('DataTable: columns and output-columns props must have the same number of elements.');
          return false;
        }

        if (this.sort && this.columns.length !== this.sort.length) {
          console.error('DataTable: columns, headers, and sort props must have the same number of elements.');
          return false;
        }

        if (this.limit && (parseInt(this.limit) !== this.limit || this.limit < 1)) {
          console.error('DataTable: row default limit must be a positive integer.');
          return false;
        }

        if (this.limits) {
          for (var l in this.limits) {
            if (parseInt(this.limits[l]) !== this.limits[l] || this.limits[l] < 1) {
              console.error('DataTable: row limits must be an array of positive integers.');
              return false;
            }
          }
        }

        if (this.sortBy && !this.columns.includes(this.sortBy)) {
          console.error('DataTable: default sort column must be in columns list.');
          return false;
        }

        if (this.sortDir && this.sortDir.toLowerCase() !== 'asc' && this.sortDir.toLowerCase() !== 'desc') {
          console.error('DataTable: default sort direction must be "asc" or "desc".');
          return false;
        }

        return true;
      },

      /**
       * Build schema from header, column props.
       * @return void
       */
      buildSchema: function() {
        this.schema = {};

        for (var c in this.columns) {
          this.schema[this.columns[c]] = {
            label: this.headers[c],
            name: this.columns[c],
            sort: this.sort[c],
            output: this.renderColumns[c],
          }

          // Set defaults from props, if valid.
          if (this.limits.includes(this.limit)) {
            this.currentLimit = this.limit;
          }
          else {
            this.currentLimit = this.limits[0];
          }

          if (this.sortBy) this.sortColumn = this.sortBy;
          if (this.sortDir) this.sortDirection = this.sortDir;
        }
      },

      /**
       * Retrieve all rows from the JSON endpoint.
       * @return void
       */
      fetchRows: function() {
        var self = this;
        this.isLoading = true;

        axios.get(this.getQueryUri()).then(function(response) {
          self.total = response.data.total;
          self.lastPage = response.data.last_page;
          self.rows = response.data.data;
          self.fromRecord = response.data.from;
          self.toRecord = response.data.to;
          self.isLoading = false;

          for (var i = 1; i < self.lastPage; i++) {
            self.pages.push(i);
          }
        });
      },

      /**
       * Retrieve a single data from a row.
       *
       * @param int rowIndex
       *   the numeric row index of total rows returned
       * @param string columnName
       *   the column name (links schema keys to dataset keys)
       * @return string
       */
      getRowData: function(rowIndex, columnName) {
        var outputColumn = this.schema[columnName].output;
        return this.rows[rowIndex][outputColumn];
      },

      /**
       * Respond to a pagination click by changing the query page.
       *
       * @param int page
       *   the number of the page link that was click
       * @return void
       */
      changePage: function(page) {
        this.currentPage = page;
        this.fetchRows();
      },

      /**
       * Respond to a header click by changing the query sort.
       *
       * @param string column
       *   the name of the column that was clicked
       * @return void
       */
      changeSort: function(column) {
        if (this.isLoading || !this.schema[column].sort) return;

        if (this.sortColumn === column) {
          if (this.sortDirection == 'asc') {
            this.sortDirection = 'desc';
          }
          else {
            this.sortDirection = 'asc';
          }
        }
        else {
          this.sortColumn = column;
          this.sortDirection = 'asc';
        }

        this.fetchRows();
      },

      /**
       * Return an edit link for a given row.
       *
       * @param object row
       *   a row of JSON data from rows
       * @param string action
       *   the name of the action to take
       * @return string
       */
      getActionLink: function(row, action) {
        var pKey = this.src + '_id';
        var redirect = '?redirect_to=' + location.pathname;
        if (row[pKey]) {
          return '/' + this.src + '/' + row[pKey] + '/' + action + redirect;
        }

        return '';
      },

      /**
       * Return a delete link for a given row.
       *
       * @param object row
       *   a row of JSON data from rows
       * @return string
       */
      getDeleteLink: function(row) {
        var pKey = this.src + '_id';
        if (row[pKey]) {
          return '/' + this.src + '/' + row[pKey] + '/delete';
        }

        return '/';
      },

      /**
       * Return table header sort classes for <th> elements.
       *
       * @param string column
       * @return string
       */
      getSortClasses: function(column) {
        var classes = 'fa';

        if (!this.schema[column].sort) return classes;

        if (column === this.sortColumn) {
          if (this.sortDirection == 'asc') {
            classes += ' fa-sort-asc';
          }
          else {
            classes += ' fa-sort-desc';
          }
        }
        else {
          classes += ' fa-sort';
        }

        return classes;
      },

      /**
       * Build a query string URL from current state.
       *
       * @return string
       */
      getQueryUri: function() {
        var sourceUrl = '/' + this.src + '/json?';
        sourceUrl += 'sort=' + this.sortColumn;
        sourceUrl += '&dir=' + this.sortDirection;
        sourceUrl += '&page=' + this.currentPage;
        sourceUrl += '&limit=' + this.currentLimit;
        return sourceUrl;
      },
    },
  }
</script>

<style lang="scss">
  .data-table {

    th {
      font-weight: normal;

      span.fa {
        display: inline-block;
        margin-right: 1em;
      }

      &.active {
        font-weight: bold;
      }

      &[data-sort] {
        cursor: ns-resize;
      }
    }

    .result-details {
      margin-top: 1em;
    }

    .row-details {
      margin-bottom: 1em;

      select {
        display: inline-block;
        margin-right: 0.5em;
        width: auto;
      }
    }

    // Overrides for specific columns.
    td[data-column='updated_at'] {
      min-width: 185px;
    }
    td[data-column='actions'] {
      min-width: 100px;
    }
  }
</style>
