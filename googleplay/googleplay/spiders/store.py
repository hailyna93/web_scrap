import scrapy
import re

from googleplay.items import GoogleplayItem

class GoogleplaySpider(scrapy.Spider):
	name = "play_store"
	allowed_domains = ["play.google.com"]
	start_urls = ["https://play.google.com/store/apps/collection/topselling_free"]

	def parse(self, response):
		unicode(response.body.decode(response.encoding)).encode('utf-8')
		for href in response.css(".card"):
			play = GoogleplayItem()
			url = href.css(".details a.title").xpath("@href").extract_first()
			url = response.urljoin(url)
			star = href.css(".reason-set .tiny-star::attr('aria-label')").extract_first()
			play['title'] = href.css(".details a.title::text").extract_first()
			play['link'] = url
			play['decs'] = href.css(".details a.subtitle::text").extract()
			play['star'] = re.search("[0-9],[0-9]", star).group()
			yield play

	