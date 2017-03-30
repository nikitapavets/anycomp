import {css} from 'styled-components'

const sizes = {
    tablet: 768,
    laptop: 992,
    desktop: 1200,
};

export const media = {
    tablet: (...args) => css`
        @media only screen and (min-width: ${sizes.tablet}px) {
            ${ css(...args) }
        }
    `,
    laptop: (...args) => css`
        @media only screen and (min-width: ${sizes.laptop}px) {
            ${ css(...args) }
        }
    `,
    desktop: (...args) => css`
        @media only screen and (min-width: ${sizes.desktop}px) {
            ${ css(...args) }
        }
    `
};

export const bgi = (img, size) => css`
    display: block; 
    background: url(${img}) no-repeat;
    background-size: ${size}px;
    width: ${size}px;
    height: ${size}px;
`;
