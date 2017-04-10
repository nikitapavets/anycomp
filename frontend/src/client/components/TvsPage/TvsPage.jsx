import React from 'react';
import CatalogLayout from '../CatalogLayout';

export default class TvsPage extends React.Component {

    componentWillMount() {
        this.props.setBreadcrumbs([
            {
                title: 'Телевизоры',
                link: '/tvs'
            }
        ]);

        this.props.handleLoadingTvs();
    }

    render() {
        return (
            <div>
                <CatalogLayout {...this.props}
                               title='Телевизоры'
                               items={this.props.tvs}
                               handleFilter={this.props.handleSearchTvs}/>
            </div>
        )
    }
}
