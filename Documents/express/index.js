const express = require("express");
const app = express();
const port = 3000;
app.use(express.json());

app.get("/", (req, res) => {
  res.send("Hello World!");
});

app.get("/employee/:id", (req, res) => {
  const id = req.query.id;
  res.json({ message: `GET Homepage by id : ${id}` });
});

app.get("/employee", (req, res) => {
  req.query.name ? res.json({ message: `GET employee by name : ${req.query.name}` }) : res.json({ message: `Get Employee` });
});

app.post(`/employee`, (req, res) => {
  const employee = req.body;
  console.log(employee);
  res.json(employee);
});
app.listen(port, () => {
  console.log(`Example app listening on port ${port}`);
});
