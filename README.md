# Matomo Agent plugin

This plugin doesn't do anything by itself, it is dependent on the [Analytics Log Agent](https://github.com/Digitalist-Open-Cloud/Analytics-Log-Agent) that needs to be up an running on your server for the website you want to track. For how to configure the Analytics Log Agent itself, please see the repo above.

The main idea with this plugin is to collect data to Matomo that you normally couldn't, and Analytics Log Agent solves that issue.

## Status

Both this plugin and Analytics Log Agent is in early alpha, and contributions are more than welcome!

## Reports

For now, the Matomo Agent plugin support one kind of report, and that is the error logs that comes Matomo Agent tailing your Apache or Nginx logs.

Normally you can't track pure server errors in Matomo, because Matomo runs in the browser, and if a server error happens, like a 503, you are not loading any JavaScripts for the web page. The plugin also tracks your 404 pages, so you could improve your SEO.

## License

Copyright (C) 2024 Digitalist Open Cloud <cloud@digitalist.com>

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.  If not, see <https://www.gnu.org/licenses/>.