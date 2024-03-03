import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'

import docsearch from '@docsearch/js';

import '@docsearch/css';

docsearch({
  container: '#docsearch',
  appId: 'JZ1I2ATO6A',
  indexName: 'nxu-tzgg-search',
  apiKey: '954996764c75fe9c9a57b759763e10b4',
});
