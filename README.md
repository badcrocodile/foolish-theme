
The Motley Fool Code Challenge
===

Included please find 3 primary components:
- **Foolish Stock Advisor:** An Underscores based theme for displaying content, as described in the requirements.
- **Foolish Company Data:** A plugin to handle API integration with the Financial Modeling Prep API, as described in the requirements.
- **Foolish Shortcodes:** A plugin to execute shortcodes that expand tickers into the commonly used format. Not in the requirements but looking at the content samples it could prove to be useful for content creators. And it was fun.

## Local Installation:
This is the easiest way to get going. Following these steps will install an Ubuntu 18.04 box and handle all the dependencies, including the installation of WordPress and populating the database with seed data, including the example content provided in the Code Challenge.

**Requirements:**
- [Git](https://git-scm.com/)
- [Vagrant](https://www.vagrantup.com/)
- [Vagrant hostsupdater](https://github.com/agiledivider/vagrant-hostsupdater)
- [VirtualBox](https://www.virtualbox.org/) 
- [Ansible](https://www.ansible.com/)

**Installation:**
1. [Download or clone the repository](https://github.com/badcrocodile/foolish-project): `git clone git@github.com:badcrocodile/foolish-project.git`
1. Fire up your terminal and cd into the newly created directory: `cd /path/to/project/`
1. Set up your server with Vagrant by running vagrant up: `vagrant up`
1. Grab some coffee (and a snack) while the server provisions. It will take about 10 minutes.
    1. The vagrant script will provision a new Ubuntu 18.04 LAMP server, wire it up and configure all dependencies.
    1. It will then install WordPress and import the database from `/sql/vagrant.sql`.
1. Once the script is done you can visit your site by visiting [http://foolish-project.vagrant](http://foolish-project.vagrant)
1. The default username and password is thefool / fool123

## Installation from Scratch
Please consider using the Vagrant installation instructions above, but if you'd rather install the files into an existing bare WP installation here's what you need to do. 

1. [Download the repository](https://github.com/badcrocodile/foolish-project).
1. Locate the _Foolish Stock Advisor_ theme directory at `/public/wp-content/themes/thefool/` and move it into your installation.
1. Locate the _Foolish Company Data_ plugin directory at `/public/wp-content/plugins/fool-company-data/` and move it to your installation.
1. Locate the _Foolish Shortcodes_ plugin directory at `/public/wp-content/plugins/fool-shortcodes` and move it to your installation.
1. Locate the `composer.json`, located at `/composer.json` and move it to your installation. 
    1. Verify that the path in `composer.json` matches your directory structure.
    1. Install dependencies with `composer install`
    1. Update the autoloader with `composer dumpautoload -o`
1. **OPTIONAL:** Locate the DB dump at `/sql/vagrant.sql` and import that into your DB. It will really speed up your requirement validation times. Note that you'll have to update `WP_HOME` and `WP_SITEURL` after this operation.
1. Locate and activate the Advanced Custom Fields plugin to support the site functionality.
     1. This theme is using ACF Local JSON for syncing of fields. Once activated, navigate to `WP Admin -> Custom Fields` and run the updater to get your fields setup. 
1. After importing the ACF fields, navigate to **WP Admin -> Theme Settings** and enter your API key.
1. Activate the _Foolish Company Data_ and _Foolish Shortcodes_ plugins.
1. Activate the _Foolish Stock Advisor_ theme.
1. Add the "Categories" widget to your primary sidebar


## Now the fun starts! Let's walk through those requirements:

---

> > ### Story 1: Create a News article
> A News article has the following requirements:
> 
> - The author needs to be able to write and edit the article.
> - The author needs to be able to associate the article with the ticker symbol for the stock being discussed, if any, e.g. NASDAQ:SBUX.
> - Once published, the article needs to display the following: 
>   - The author’s name 
>   - The date that the article was published 
>   - The article itself

**Steps to validate:**
- The easy way: 
  - Navigate to [_Starbucks Reports Record Quarter, but Challenges Remain_](http://foolish-project.vagrant/2018/07/starbucks-reports-record-quarter-but-challenges-remain/)
  - Notice that authors name, publish date, and article content are all displayed.
  - Click the "Edit Post" link in the WP Admin bar to validate the requirement of writing and editing the article.
- Alternatively:
  - Log in to the admin and create your own post.
  - To associate the article with a ticker symbol:
    - Make sure that "Post" is the active selection for the sidebar. 
    - Locate the "Associated Company" metabox in the sidebar.
    - Select a company ticker from the list. If your desired company isn't listed, click the blue "+" (plus) sign to add a new ticker.
  - Optionally assign a category
  - Publish your content
    
---

> > ### Story 2: Create a Stock Recommendation article
> The Stock Recommendation article has the following requirements:
>
> - The author needs to be able to write and edit the article. 
> - The author needs to be able to associate the article with the ticker symbol for the stock being recommended, e.g. NASDAQ:SBUX.
> - Once published, the article needs to display the following:
>   - The author’s name
>   - The date that the recommendation was published
>   - The article itself 
> - In a sidebar or callout box, it should display the following pieces of company profile information, which will come from an API call (see note below):
>   - Company Logo
>   - Company Name
>   - Exchange
>   - Description
>   - Industry
>   - Sector
>   - CEO Website URL

**Steps to Validate:**
- The easy way:
    - Navigate to [_Buy Starbucks (SBUX)_](http://foolish-project.vagrant/2021/04/buy-starbucks/)
    - Notice that authors name, publish date, and article content are all displayed.
    - Click the "Edit Post" link in the WP Admin bar to validate the requirement of writing and editing the article.
    - Scroll to the bottom of the post and notice that there is a callout box containing all required information, delivered via the Financial Modeling Prep API.
- Alternatively:
    - Log in to the admin and create your own post.
    - To associate the article with a ticker symbol:
        - Make sure that "Post" is the active selection for the sidebar.
        - Locate the "Companies" taxonomy metabox in the sidebar.
        - Typing a few characters of your desired Company will trigger an auto-population dropdown. Select your company ticker from the list of available matches. 
          If your desired company isn't listed that's okay, just finish typing the company name. Your company will be automatically created and available via auto-population the
          next time you need it. The expectation for this field is company ticker.
    - Assign the post to category "Stock Recommendation".
    - Publish your content.

---

> > ### Story 3: Create a Stock Recommendation archive page
> The Stock Recommendation archive page should include the following:
>
> - A list of links to all of the Stock Recommendation articles that have been published, in reverse chronological order (newest first), showing 10 at a time
> - Each Stock Recommendation should show the title of the article as well as the ticker symbol, e.g. “Buy Starbucks (NASDAQ:SBUX)”

**Steps to Validate:**
- Navigate to the [Stock Recommendation archive page](http://foolish-project.vagrant/category/stock-recommendation/)
- Notice that both requirements for this page have been met.      

---

> > ### Story 4: Create a Company Page
> We want a page on the site for each company that we write about. The Company Page should include the following:
>
> - The name of the company and the company logo in the header
> - A description of the company
> - A side box or table that contains the following financial data, which will come from an API call (see note below):
>   - Price
>   - Price change
>   - Price change in percentage
>   - 52 week range
>   - Beta
>   - Volume
>   - Average
>   - Market Capitalisation
>   - Last Dividend (if any, otherwise display “N/A”)
> - If the company has been recommended, a list of links to the recommendation articles should be displayed under the header “Recommendations”, in reverse chronological order (newest first).
> - Any News articles should be listed under the header “Other Coverage” in reverse chronological order (newest first). If there are more than 10 articles, the user should be able to page through them. Subsequent pages should contain everything except the list of Recommendation articles.

**Steps to Validate:**
- The easy way:
    - Navigate to the [Starbucks Company Page](http://foolish-project.vagrant/company/sbux/)
    - Notice that the description of the company exists as the main content, with the company logo placed to the right.
    - Notice that company Financial Data is displayed in a table below the description.
    - Notice that Previous Recommendations exist in a callout box below the financial information.
    - Notice that below the previous recommendations, Other Coverage is displayed in a callout box.
      - Notice that users can paginate through the list of articles using the pagination links.
      - Notice that this list excludes articles posted in Previous Recommendations
    
---

## Callouts

- Apologies for making the assumption that your directory path will look like mine in `composer.json`. I should have used plugin-specific composer files as opposed to a global site file.
- I set a stretch goal of using transients to cache the data returned by the API, but ran out of time.
- Although Posts support adding multiple Companies, doing so is not supported with existing functionality nor outlined in the requirements. Each Post should only contain 1 company relationship.
- There are logs tracking API errors at `/public/wp-content/plugins/fool-company-data/logs/`. I left mine in the repo if you're interested.
- I'd considered using Guzzle for the API client but decided it was overkill for this project, as there's no OAuth or PUT's or POST's to deal with.
- If you're writing a filter for `the_title` but start testing before your logic before the final `return` statement is in place a lot of your posts will have a blank title and this will cause an infinite loop in some situations, which is super cool.

---

## Wrapping Up

Thank you for this opportunity, it was a fun challenge! It was a great mix of all the things that go into modern WordPress development. 

I hope the installation goes well. After writing this documentation there were a few things that jumped out at me that I could have done differently to make the process easier...creating a plugin settings dashboard to hold the API key instead of using ACF for example... but I was already pushing time and wanted to respect the requirements.

There are also hard dependencies between the theme and the Foolish Company Data plugin. I'd have liked to have decoupled those more gracefully. 
Actually there are about a million things I'd liked to have put more time into, but I think that's always the case about the things we create. But at some point we just have to let it go... so here it is, in all of its imperfect glory :) 

Please feel free to hit me up anytime 24/7 with questions or if you run into issues, and best of luck on your search.

Peace,

Jason  
jason@coolguy.org  
574-903-3563

