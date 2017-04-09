import React from 'react';
import CatalogLayout from '../CatalogLayout';

export default class NotebooksPage extends React.Component {

    componentWillMount() {
        this.props.setBreadcrumbs({
            title: 'Ноутбуки',
            link: '/notebooks'
        });
    }

    render() {
        return (
            <div>
                <CatalogLayout breadcrumbs={this.props.breadcrumbs} title='Ноутбуки'/>
            </div>
        )
    }
}
