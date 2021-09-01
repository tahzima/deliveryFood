import logo from './logo.svg';
import './App.css';
import {BrowserRouter, Switch, Route} from 'react-router-dom';
import HomeScreen from './screens/HomeScreen';


function App() {
  return (
    <BrowserRouter>
      <Switch>
        <Route path="/" component={HomeScreen} />
      </Switch>
    </BrowserRouter>
  );
}

export default App;
