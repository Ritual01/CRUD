<?php
// header.php
?><!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agenda - CRUD</title>
 <style>
  body {
    font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, 'Helvetica Neue', Arial, sans-serif;
    margin: 0;
    background: #1a0033; /* morado oscuro elegante */
    color: #eaeaea;
  }

  a {
    color: #b48eff; /* violeta suave */
    text-decoration: none;
  }

  .container {
    max-width: 980px;
    margin: 32px auto;
    padding: 0 16px;
  }

  .card {
    background: #2a0055; /* morado intermedio */
    border: 1px solid #3b0077;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
  }

  h1, h2 {
    margin: 0 0 12px;
    color: #ffffff;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 12px;
    background: #220046;
  }

  th, td {
    padding: 10px;
    border-bottom: 1px solid #3b0077;
    text-align: left;
  }

  th {
    background: #31006b;
    color: #e2d9ff;
  }

  tr:nth-child(even) {
    background-color: #250052;
  }

  .actions a {
    margin-right: 8px;
  }

  .btn {
    display: inline-block;
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid #3b0077;
    background: #31006b;
    color: #eaeaea;
    transition: all 0.2s ease;
  }

  .btn:hover {
    background: #4b00a1;
  }

  .btn.primary {
    background: #6b00b6;
    border-color: #6b00b6;
    color: #fff;
  }

  .btn.primary:hover {
    background: #8a2be2;
  }

  .btn.warn {
    background: #b31a1a;
    border-color: #b31a1a;
    color: #fff;
  }

  .btn.warn:hover {
    background: #e03a3a;
  }

  .grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  label {
    display: block;
    font-size: 0.9rem;
    margin-bottom: 6px;
    color: #dcd3ff;
  }

  input, select {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #3b0077;
    background: #1a0033;
    color: #eaeaea;
  }

  .row {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }

  .row > * {
    flex: 1;
  }

  .topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
  }

  .notice {
    padding: 10px;
    border: 1px solid #3b0077;
    background: #220046;
    border-radius: 10px;
    color: #cfc3ff;
  }

  .search {
    display: none; /* buscador eliminado */
  }
</style>
</head>
<body>
  <div class="container">
