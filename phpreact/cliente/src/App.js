import React from "react";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import CategoryCreate from "./components/CategoryCreate";
import CategoryEdit from "./components/CategoryEdit";
import CategoryList from "./components/CategoryList";
import CategoryShow from "./components/CategoryShow";

function App() {
  return (
    <Router>
      <div className="container">
        <h1 className="my-4">Category Management</h1>
        <Routes>
          <Route path="/" element={<CategoryList />} />
          <Route path="/create" element={<CategoryCreate />} />
          <Route path="/edit/:id" element={<CategoryEdit />} />
          <Route path="/list" element={<CategoryList />} />
          <Route path="/show/:id" element={<CategoryShow />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
