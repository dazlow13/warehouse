import './sidebar';
import './bootstrap';
import './transaction';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

// DataTables Bootstrap 5
import DataTable from 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.css';

// khởi tạo plugin DataTables (global)
window.DataTable = DataTable;