import { Menu } from '../shared/header.js';
import { Banner } from './banner.js';
import { bannerContent } from './bannerContent.js';

new Menu().initialize();
new Banner(bannerContent, 5000).initialize();