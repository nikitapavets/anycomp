import React from 'react';
import CatalogLayout from '../CatalogLayout';

export default class NotebooksPage extends React.Component {

    componentWillMount() {
        this.props.setBreadcrumbs([
            {
                title: 'Ноутбуки',
                link: '/notebooks'
            }
        ]);

        this.props.handleLoadingNotebooks();
    }

    render() {
        return (
            <div>
                <CatalogLayout {...this.props} title='Ноутбуки' items={this.props.notebooks}
                               handleFilter={this.props.handleSearchNotebooks}/>
            </div>
        )
    }
}
