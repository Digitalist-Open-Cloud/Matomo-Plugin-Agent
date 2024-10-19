# Matomo Agent plugin

This plugin doesn't do anything by itself, it is dependent on the [Matomo Agent](https://github.com/Digitalist-Open-Cloud/Matomo-Agent) that needs to be up an running on your server for the website you want to track. For how to configure the Matomo Agent itself, please see the repo.

One of the ideas about the Matomo Agent is to collect data to Matomo that you normally couldn't, and this plugin shows that data.

When we write Matomo Agent - we mean the binary that you should install on your server, and when we write Matomo Agent plugin, we refer to this plugin.

## Reports

For now, the Matomo Agent plugin support one kind of report, and that is the error logs that comes Matomo Agent tailing your Apache or Nginx logs.

Normally you can't track pure server errors in Matomo, because Matomo runs in the browser, and if a server error happens, like a 503, you are not loading any JavaScripts for the web page. The plugin also tracks your 404 pages, so you could improve your SEO.
